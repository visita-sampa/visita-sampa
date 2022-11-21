<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
	public function index()
	{
		return view('contact');
	}

	public function sendEmail(Request $request)
	{
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
			$mail->addAddress(env('MAIL_USERNAME'), $request->name);     //Add a recipient

			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Visita Sampa - contato';
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

                    /* style contact */
                    .table {
                      margin: auto;
                      min-width: 30%;
                      max-width: 60%;
                    }

                    th, td {
                      padding: 0.5rem;
                    }
                </style>
            </head>
            <div class="d-flex bg-light p-3 email ">
                <div class="card w-75 h-100 m-2 p-3 m-auto">
                    <a href="https://visita-sampa.herokuapp.com/" class="m-auto" target="_blank">
                        <img class="logo card-img-top" src="https://visita-sampa.herokuapp.com/assets/img/logoVisitaSampa.png" alt="Logo Visita Sampa" />
                    </a>
                    <div class="card-body">
                        <h3>Contato</h3>
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Conteúdo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Nome</th>
                                        <td>' . $request->name . '</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">E-mail</th>
                                        <td>' . $request->email . '</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Assunto</th>
                                        <td>' . $request->subject . '</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mensagem</th>
                                        <td>' . $request->comments . '</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr class="m-2">
                            <div class="mt-2 fw-light fs-6">
                                <p class="m-0">&copy; 2022 Copyright:</p>
                                <p class="">Todos os direitos reservados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
			$mail->AltBody = 'Contato \n\nNome: ' . $request->name . '\n\nE-mail: ' . $request->email . '\n\nAssunto' . $request->subject . '\n\nMensagem: ' . $request->comments;

			$mail->send();

			$msgEmail = "O e-mail foi enviado.";
			return redirect()->route('contact', app()->getLocale())->with('msgEmailSendSuccess', $msgEmail);
		} catch (Exception $e) {
			$msgEmail = "O e-mail não podê ser enviado. Tente novamente.";
			return redirect()->route('contact', app()->getLocale())->with('msgEmailSendFail', $msgEmail);
		}
	}
}
