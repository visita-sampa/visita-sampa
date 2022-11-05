<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\answer;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$user = DB::table('usuario')
			->where('nome_usuario', Auth::user()->nome_usuario)
			->first();

		$profile = DB::table('classificacao_perfil_roteiro')
			->where('id_classificacao', Auth::user()->fk_classificacao_perfil_roteiro_id_classificacao)
			->get();

		// $publications = DB::table('publicacao')
		// 	->where('fk_usuario_id_usuario', Auth::user()->id_usuario)
		// 	->orderBy('id_publicacao', 'desc')
		// 	->paginate(12);

		$publications = DB::table('publicacao')
			->join('usuario', function ($join) {
				$join->on('publicacao.fk_usuario_id_usuario', '=', 'usuario.id_usuario');
			})
			->join('ponto_turistico', function ($join) {
				$join->on('publicacao.fk_ponto_turistico_id_ponto_turistico', '=', 'ponto_turistico.id_ponto_turistico');
			})
			->select('publicacao.id_publicacao', 'publicacao.midia', 'publicacao.legenda', 'ponto_turistico.nome_ponto_turistico', 'publicacao.data', 'publicacao.updated_at', 'usuario.nome', 'usuario.nome_usuario', 'usuario.id_usuario', 'usuario.foto_perfil')
			->where('fk_usuario_id_usuario', Auth::user()->id_usuario)
			->orderBy('id_publicacao', 'desc')
			->paginate(12);

		date_default_timezone_set('America/Sao_Paulo');

		$now = time();

		foreach ($publications as $post) {
			if ($post->data != $post->updated_at) {
				$post->updated_at = round(($now - strtotime($post->updated_at)) / (60 * 60 * 24));
			} else {
				$post->data = round(($now - strtotime($post->data)) / (60 * 60 * 24));
			}
		}

		if ($request->ajax()) {
			$view = view('userPublication', ['publications' => $publications])->render();
			return response()->json(['html' => $view]);
		}

		return view('user',  ['user' => $user, 'profile' => $profile, 'publications' => $publications]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	// public function create()
	// {
	//     //
	// }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$user = new User;

		$user->nome = $request->nameSignup;
		$user->nome_usuario = $request->usernameSignup;
		$user->email = $request->emailSignup;
		$user->senha = bcrypt($request->passwordSignup);
		$user->chave_confirmacao = bcrypt($request->emailSignup . date("Y-m-d H:i:s"));
		$user->chave_confirmacao = str_replace('/', '', $user->chave_confirmacao);

		$validateCredencials = $this->validateCredentials($user);

		if ($validateCredencials) {
			$mail = new PHPMailer(true);

			try {
				//Server settings
				// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
				$mail->CharSet    = 'UTF-8';
				$mail->isSMTP();
				$mail->Host       = env('MAIL_HOST');
				$mail->SMTPAuth   = true;
				$mail->Username   = env('MAIL_USERNAME');
				$mail->Password   = env('MAIL_PASSWORD');
				$mail->SMTPSecure = env('MAIL_ENCRYPTION');
				$mail->Port       = env('MAIL_PORT');

				//Recipients
				$mail->setFrom(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
				$mail->addAddress($request->emailSignup, $request->nameSignup);     //Add a recipient

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'Visita Sampa - confirmação de e-mail';
				$mail->Body    = '
				<head>
				<style>
				@import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300&display=swap");
				</style>
				<style>
					* {
						font-family: "Roboto", sans-serif;
						margin: 0;
						padding: 0;
						box-sizing: border-box;
					}
					
					body {
						color: #212529 !important;
					}
					
					.email p {
						color: #26547c !important;
					}
					
					.logo {
						width: 7.7rem;
					}
					
					h3 {
						font-size: 1.5rem;
						margin-top: 0;
						margin-bottom: 0.5rem;
						font-weight: 500;
						line-height: 1.2;
					}
					
					.bg-light {
						background-color: rgba(248,249,250,1)!important;
					}
					
					.p-3 {
						padding: 1rem!important;
					}
					
					.d-flex {
						display: flex!important;
						flex-direction: column!important;
					}
					
					.flex-column {
						flex-direction: column!important;
					}
					
					.m-0 {
						margin: 0!important;
					}
					
					.m-2 {
						margin: 0.5rem!important;
					}
					
					.mt-2 {
						margin-top: 0.5rem!important;
					}
					
					.mt-3 {
						margin-top: 1rem!important;
					}
					
					.m-auto {
						margin: auto!important;
					}
					
					.h-100 {
						height: 100%!important;
					}
					
					.w-75 {
						width: 75%!important;
					}
					
					.card {
						position: relative;
						flex-direction: column;
						min-width: 0;
						word-wrap: break-word;
						background-color: #fff;
						background-clip: border-box;
						border: 1px solid rgba(0,0,0,.125);
						border-radius: 0.25rem;
						text-align: center;
					}
					
					.card-body {
						flex: 1 1 auto;
						padding: 1rem 1rem;
						text-align: left;
					}
					
					p {
						margin-top: 0;
						margin-bottom: 1rem;
						font-size: 1rem!important;
					}
					
					hr:not([size]) {
						height: 1px;
					}
					
					hr {
						margin: 1rem 0;
						color: 26547c;
						background-color: currentColor;
					}
					
					.fw-light {
						font-weight: 300!important;
					}
					
					.fs-6 {
						font-size: 1rem!important;
					}
					
					.btn {
						display: inline-block;
						font-weight: 400;
						line-height: 1.5;
						color: #212529 !important;
						text-align: center;
						text-decoration: none;
						vertical-align: middle;
						cursor: pointer;
						-webkit-user-select: none;
						-moz-user-select: none;
						user-select: none;
						background-color: transparent;
						border: 1px solid transparent;
						padding: 0.375rem 0.75rem;
						font-size: 1rem;
						border-radius: 0.25rem;
						transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
					}
					
					.btn-danger {
						color: #fff !important;
						background-color: #dc3545;
						border-color: #dc3545;
					}
					
					.btn-danger:hover {
						color: #fff !important;
						background-color: #bb2d3b;
						border-color: #b02a37;
					}
				</style>
				</head>
				<div class="d-flex bg-light p-3 email ">
					<div class="card w-75 h-100 m-2 p-3 m-auto">
						<a href="https://visita-sampa.herokuapp.com/" class="m-auto" target="_blank">
							<img class="logo card-img-top" src="https://visita-sampa.herokuapp.com/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
						</a>
						<div class="card-body">
							<h3>Confirmação de e-mail</h3>
							<div>
								<p>Olá, ' . $request->nameSignup . '</p>
								<p>Agradecemos a sua visita em nosso site! Para finalizar seu cadastro, confirme seu endereço de e-mail clicando no link abaixo: </p>
								<div class="d-flex m-auto">
									<a href="https://visita-sampa.herokuapp.com/pt/emailConfirmation/' . $user->chave_confirmacao . '" class="btn btn-danger m-auto">Confirmar e-mail</a>
								</div>
								<p class="mt-3">Após a confirmação será possível entrar no sistema com suas credenciais.</p>
								<hr class="m-2">
								<div class="mt-2 fw-light fs-6">
									<p class="m-0">&copy; 2021 Copyright:</p>
									<p class="">Todos os direitos reservados</p>
								</div>
							</div>
						</div>
					</div>
				</div>';
				$mail->AltBody = 'Olá, ' . $request->nameSignup . '\n\nAgradecemos a sua visita em nosso site! Para finalizar seu cadastro, confirme seu endereço de e-mail clicando no link abaixo: \n\nhttps://visita-sampa.herokuapp.com/pt/emailConfirmation/' . $user->chave_confirmacao;

				$checkEmail = $mail->send();

				if ($checkEmail) {
					$user->save();

					$this->checkQuizAnswer($user);

					$msg = "Seu cadastro está em andamenteo. Para finalizar, acesse seu e-mail para confirmar o endereço cadastrado";
					return redirect()->route('signup', app()->getLocale())->with('msgSendEmailConfirmationSuccess', $msg);
				}
			} catch (Exception $e) {
				$msg = "Não foi possível concluir o seu cadastro. Tente novamente.";
				return redirect()->route('signup', app()->getLocale())->with('msgSendEmailConfirmationFail', $msg);
			}

			$findUser = $user->where('email', $request->emailSignup)->first();
		}
		return redirect()->route('login', app()->getLocale());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, $language, $id = null)
	{
		if ($id == null) {
			$id = Auth::user()->nome_usuario;
		}

		$user = DB::table('usuario')
			->where('nome_usuario', $id)
			->first();

		$profile = DB::table('classificacao_perfil_roteiro')
			->where('id_classificacao', $user->fk_classificacao_perfil_roteiro_id_classificacao)
			->get();

		$publications = DB::table('publicacao')
			->where('fk_usuario_id_usuario', $user->id_usuario)
			->where(function ($query) {
				$query
					->where('publicacao.situacao', false)
					->orWhereNull('publicacao.situacao');
			})
			->orderBy('id_publicacao', 'desc')
			->paginate(12);

		date_default_timezone_set('America/Sao_Paulo');

		$now = time();

		foreach ($publications as $post) {
			if ($post->data != $post->updated_at) {
				$post->updated_at = round(($now - strtotime($post->updated_at)) / (60 * 60 * 24));
			} else {
				$post->data = round(($now - strtotime($post->data)) / (60 * 60 * 24));
			}
		}

		if ($request->ajax()) {
			$view = view('userPublication', ['publications' => $publications])->render();
			return response()->json(['html' => $view]);
		}

		return view('user',  ['user' => $user, 'profile' => $profile, 'publications' => $publications]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\user  $user
	 * @return \Illuminate\Http\Response
	 */
	// public function edit(user $user)
	// {
	//     //
	// }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$user = Auth::user();
		$last_profile_pic = null;

		if ($request->base64image) {
			$last_profile_pic = $user->foto_perfil;

			$response = cloudinary()->upload($request->base64image, array("folder" => "profile-pic", "overwrite" => TRUE, "resource_type" => "image"))->getSecurePath();

			$user->foto_perfil = $response;
		}

		if ($request->floatingName) {
			$user->nome = $request->floatingName;
		}

		if ($request->floatingUsername) {
			$user->nome_usuario = $request->floatingUsername;
		}

		if ($request->floatingBio) {
			$user->descricao = $request->floatingBio;
		}

		if ($request->floatingPassword) {
			if (Hash::check($request->floatingPassword, $user->senha)) {
				if ($request->floatingNewPassword && $request->floatingRepeatPassword) {
					if ($request->floatingNewPassword == $request->floatingRepeatPassword) {
						$user->senha = bcrypt($request->floatingNewPassword);
					} else {
						$msg = "Verifique a confirmação de senha";
						return redirect()->route('user', app()->getLocale())->with('msgPasswordComparisonFailed', $msg);
					}
				} else {
					$msg = "Preencha os campos para atualização de senha";
					return redirect()->route('user', app()->getLocale())->with('msgUnfilledPasswordFields', $msg);
				}
			} else {
				$msg = "Senha atual inválida";
				return redirect()->route('user', app()->getLocale())->with('msgInvalidCurrentPassword', $msg);
			}
		}

		if ($user->save()) {
			if ($last_profile_pic) {
				$this->deleteLastProfilePic($last_profile_pic);
			}
			$msg = "Perfil atualizado";
			return redirect()->back()->with('msgUpdateProfileSuccess', $msg);
		}

		$msg = "Não foi possível atualizar o perfil";
		return redirect()->back()->with('msgUpdateProfileFail', $msg);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\user  $user
	 * @return \Illuminate\Http\Response
	 */
	// public function destroy(user $user)
	// {
	//     //
	// }

	public function signup()
	{
		if (Auth::user()) {
			return redirect()->route('feed', app()->getLocale());
		}

		return view('signup');
	}

	public function validateCredentials($user)
	{
		$findUserByEmail = $user->where('email', $user->email)->first();
		$findUserByUsername = $user->where('nome_usuario', $user->nome_usuario)->first();

		if (!empty($findUserByEmail) || !empty($findUserByUsername))
			return false;
		else
			return true;
	}

	public function emailConfirmation($language, $key = null)
	{
		if (!empty($key)) {
			$findUser = DB::table('usuario')->where('chave_confirmacao', $key)->value('id_usuario');

			if (!empty($findUser)) {

				$confirm = DB::table('usuario')
					->where('id_usuario', $findUser)
					->update(['situacao_cadastro' => 1]);

				DB::table('usuario')
					->where('id_usuario', $findUser)
					->update(['email_verified_at' => now()]);

				DB::table('usuario')
					->where('id_usuario', $findUser)
					->update(['chave_confirmacao' => null]);

				if ($confirm) {
					$msg = "E-mail confirmado. Faça login com suas credenciais";
					return redirect()->route('login', app()->getLocale())->with('msgSignupCompleted', $msg);
				} else {
					$msg = "E-mail não confirmado.";
					return redirect()->route('signup', app()->getLocale())->with('msgSignupNotCompleted', $msg);
				}
			} else {
				$msg = "Endereço inválido.";
				return redirect()->route('signup', app()->getLocale())->with('msgInvalidLink', $msg);
			}
		} else {
			$msg = "Endereço inválido.";
			return redirect()->route('signup', app()->getLocale())->with('msgInvalidLink', $msg);
		}
	}

	public function checkUsernameAvailability(Request $request)
	{
		$findUserByUsername = User::where('nome_usuario', $request->floatingUsername)->first();

		if (Auth::user()) {
			if ($findUserByUsername == null || Auth::user()->nome_usuario == $request->floatingUsername) {
				$response = true;
			} else {
				$response = false;
			}
		} else {
			if ($findUserByUsername == null) {
				$response = true;
			} else {
				$response = false;
			}
		}


		return $response;
	}

	public function checkEmailAvailability(Request $request)
	{
		$findUserByEmail = User::where('email', $request->floatingEmail)->first();

		if (Auth::user()) {
			if ($findUserByEmail == null || Auth::user()->email == $request->floatingEmail) {
				$response = true;
			} else {
				$response = false;
			}
		} else {
			if ($findUserByEmail == null) {
				$response = true;
			} else {
				$response = false;
			}
		}


		return $response;
	}

	public function checkQuizAnswer($user)
	{
		$personality = request()->cookie('personality');
		$answers = json_decode(request()->cookie('quiz-answers'), true);
		$answer = new Answer;

		if ($answers && $personality) {
			$answer->questao_1 = $answers['question-1'];
			$answer->questao_2 = $answers['question-2'];
			$answer->questao_3 = $answers['question-3'];
			$answer->questao_4 = $answers['question-4'];
			$answer->questao_5 = $answers['question-5'];
			$answer->questao_6 = $answers['question-6'];
			$answer->questao_7 = $answers['question-7'];
			$answer->questao_8 = $answers['question-8'];
			$answer->questao_9 = $answers['question-9'];
			$answer->questao_10 = $answers['question-10'];
			$answer->questao_11 = $answers['question-11'];
			$answer->questao_12 = $answers['question-12'];
			$answer->questao_13 = $answers['question-13'];
			$answer->questao_14 = $answers['question-14'];
			$answer->questao_15 = $answers['question-15'];

			$answer->save();

			DB::table('usuario_questionario_resposta')
				->where('fk_usuario_id_usuario', $user->id_usuario)
				->update(['fk_respostas_id_resposta' => $answer->id_resposta]);

			DB::table('usuario')
				->where('id_usuario', $user->id_usuario)
				->update(['fk_classificacao_perfil_roteiro_id_classificacao' => $personality, 'fk_classificacao_perfil_roteiro_id_roteiro' => $personality]);

			Cookie::forget('personality');
			Cookie::forget('quiz-answers');
		}
		return;
	}

	public function deleteLastProfilePic($profile_pic)
	{

		foreach (explode('/', $profile_pic) as $row) {
			$midia = $row;
		}
		foreach (array_reverse(explode('.', $midia)) as $row) {
			$midia = $row;
		}

		$response = cloudinary()->destroy('profile-pic/' . $midia);

		return $response;
	}
}
