<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

  public function login()
  {
    if (Auth::user()) {
      $findAdmin = DB::table('administrador')
        ->where('fk_usuario_id_usuario', Auth::user()->id_usuario)
        ->first();

      if ($findAdmin) {
        return redirect()->route('adminEvents', app()->getLocale());
      } else {
        return redirect()->route('feed', app()->getLocale());
      }
    } else
      return view('login');
  }

  public function validateLogin(Request $request)
  {
    $request->validate([
      'login' => 'required',
      'passwordLogin' => 'required'
    ]);

    $user = new User;

    $findUser = $user->where('email', $request->login)->first();
    if (empty($findUser))
      $findUser = $user->where('nome_usuario', $request->login)->first();

    if (empty($findUser)) {
      $msg = "Esse usuário não existe. Verifique suas credenciais";
      return redirect()->route('login', app()->getLocale())->with('msgUserNotFound', $msg);
    }

    if ($findUser->situacao_cadastro != 1) {
      $msg = "Erro: O cadastro não foi finalizado. Verifique seu e-mail para confirmar suas credenciais.";
      return redirect()->route('login', app()->getLocale())->with('msgEmailNotConfirmed', $msg);
    } elseif (!empty($findUser) && Hash::check($request->passwordLogin, $findUser->senha)) {
      Auth::loginUsingId($findUser->id_usuario);
    } else {
      $msg = 'Senha inválida';
      return back()->with('msgInvalidPassword', $msg);
    }

    return redirect()->route('login', app()->getLocale());
  }

  public function recoverPassword()
  {
    return view('recoverPassword');
  }

  public function passwordRequest(Request $request)
  {
    $user = new User;
    $user = $user->where('email', $request->email)->first();

    if (!empty($user)) {
      $user->recuperar_senha = bcrypt($user->id_usuario . date("Y-m-d H:i:s"));
      $user->recuperar_senha = str_replace('/', '', $user->recuperar_senha);

      if ($user->save()) {
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
          $mail->addAddress($request->email, $user->nome);     //Add a recipient

          //Content
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Visita Sampa - recuperação de senha';
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
                                <h3>Recuperação de senha</h3>
                                <div>
                                    <p>Olá, ' . $user->nome . '</p>
                                    <p>Recebemos sua solicitação de atualização de senha. Para continuar, clique no link a seguir e redefina uma nova senha para sua conta: </p>
                                    <div class="d-flex m-auto">
                                        <a href="http://localhost/pt/resetPassword/' . $user->recuperar_senha . '" class="btn btn-danger m-auto">Redefinir senha</a>
                                    </div>
                                    <p class="mt-3">Após confirmar uma nova senha, sua senha anterior não será mais válida.</p>
                                    <hr class="m-2">
                                    <div class="mt-2 fw-light fs-6">
                                        <p class="m-0">&copy; 2021 Copyright:</p>
                                        <p class="">Todos os direitos reservados</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
          $mail->AltBody = 'Olá, ' . $user->nome . '\n\nRecebemos sua solicitação de atualização de senha. Para continuar, clique no link a seguir e redefina uma nova senha para sua conta: \n\nhttp://localhost/pt/resetPassword/' . $user->recuperar_senha . '\n\nApós confirmar uma nova senha, sua senha anterior não será mais válida.\n\n&copy; 2021 Copyright:\n\nTodos os direitos reservados.';

          $mail->send();

          $msg = "Enviamos um e-mail com o link para atualização de senha. Verifique sua caixa de entrada.";
          return redirect()->route('recover.password', app()->getLocale())->with('msgSendUpdatePasswordEmailSuccess', $msg);
        } catch (Exception $e) {
          $msg = "O e-mail não pôde ser enviado. Tente novamente em alguns instantes.";
          return redirect()->route('recover.password', app()->getLocale())->with('msgSendUpdatePasswordEmailFail', $msg);
        }
      } else {
        $msg = "Falha na solicitação de recuperação de senha. Tente novamente.";
        return redirect()->route('recover.password', app()->getLocale())->with('msgUpdatePasswordRequestFail', $msg);
      }
    } else {
      $msg = "Usuário não encontrado. Verifique o e-mail fornecido para recuperação de senha.";
      return redirect()->route('recover.password', app()->getLocale())->with('msgFindUserFail', $msg);
    }
  }

  public function resetPassword($language, $key = null)
  {
    if (!empty($key)) {
      $user = new User;
      $user = $user->where('recuperar_senha', $key)->first();

      if (!empty($user)) {
        return view('resetPassword', ['key' => $key]);
      } else {
        $msg = "Link inválido. Solicite um novo link.";
        return redirect()->route('recover.password', app()->getLocale())->with('msgInvalidLink', $msg);
      }
    } else {
      $msg = "Link inválido. Solicite um novo link.";
      return redirect()->route('recover.password', app()->getLocale())->with('msgInvalidLink', $msg);
    }
  }

  public function updatePassword(Request $request)
  {
    if (!empty($request->key)) {
      $user = new User;
      $user = $user->where('recuperar_senha', $request->key)->first();

      $user->senha = bcrypt($request->password);

      if ($user->save()) {
        $user->recuperar_senha = null;
        $user->save();

        $msg = "Sua senha foi atualizada. Entre com sua nova senha.";
        return redirect()->route('login', app()->getLocale())->with('msgUpdatePasswordSuccess', $msg);
      } else {
        $msg = "Falha na atualização de senha. Tente novamente.";
        return redirect()->route('reset.password', app()->getLocale())->with('msgUpdatePasswordFail', $msg);
      }
    }
  }

  public function emailStyle()
  {
    return view('emailStyle');
  }
}
