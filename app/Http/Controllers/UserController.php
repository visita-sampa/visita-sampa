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

		$publications = DB::table('publicacao')->where('fk_usuario_id_usuario', Auth::user()->id_usuario)
			->orderBy('id_publicacao', 'desc')
			->paginate(12);

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
			$user->save();

			$this->checkQuizAnswer($user);

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
				$mail->Body    = 'Olá, ' . $request->nameSignup . '<br><br>Agradecemos a sua visita em nosso site! Para finalizar seu cadastro, confirme seu endereço de e-mail clicando no link abaixo: <br><br> <a href="http://localhost/pt/emailConfirmation/' . $user->chave_confirmacao . '">Clique aqui</a>';
				$mail->AltBody = 'Olá, ' . $request->nameSignup . '\n\nAgradecemos a sua visita em nosso site! Para finalizar seu cadastro, confirme seu endereço de e-mail clicando no link abaixo: \n\nhttp://localhost/pt/emailConfirmation/' . $user->chave_confirmacao;

				$mail->send();

				$msg = "Seu cadastro está em andamenteo. Para finalizar, acesse seu e-mail para confirmar o endereço cadastrado";
				return redirect()->route('signup', app()->getLocale())->with('msgSendEmailConfirmationSuccess', $msg);
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

		$publications = DB::table('publicacao')->where('fk_usuario_id_usuario', $user->id_usuario)
			->orderBy('id_publicacao', 'desc')
			->paginate(12);

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

		if ($request->base64image) {
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
			$msg = "Perfil atualizado";
			return redirect()->route('user', app()->getLocale())->with('msgUpdateProfileSuccess', $msg);
		}

		$msg = "Não foi possível atualizar o perfil";
		return redirect()->route('user', app()->getLocale())->with('msgUpdateProfileFail', $msg);
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
					return redirect()->route('signup', app()->getLocale())->with('msgSignupCompleted', $msg);
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

		if ($findUserByUsername == null || Auth::user()->nome_usuario == $request->floatingUsername) {
			$response = true;
		} else {
			$response = false;
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
}
