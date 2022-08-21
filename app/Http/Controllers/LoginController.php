<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class LoginController extends Controller
{

    public function login()
    {
        if (Auth::user())
            return redirect()->route('user', app()->getLocale());
        else
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

        if($findUser->situacao_cadastro != 1) {
            $msgLogin = "Erro: O cadastro não foi finalizado. Verifique seu e-mail para confirmar suas credenciais.";
            return redirect()->route('login', app()->getLocale())->with('msgLogin', $msgLogin);
        }
        elseif (!empty($findUser) && Hash::check($request->passwordLogin, $findUser->senha)) {
            Auth::loginUsingId($findUser->id_usuario);
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

        if(!empty($user)) {
            $user->recuperar_senha = bcrypt($user->id_usuario . date("Y-m-d H:i:s"));
            $user->recuperar_senha = str_replace('/', '', $user->recuperar_senha);

            if($user->save()) {
                $mail = new PHPMailer(true);
                
                try {
                    //Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->CharSet    = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'sigma5.equipe@gmail.com';
                    $mail->Password   = 'dpmezmrzuguxulwd';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;
    
                    //Recipients
                    $mail->setFrom('sigma5.equipe@gmail.com', 'Visita Sampa');
                    $mail->addAddress($request->email, $user->nome);     //Add a recipient
    
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Visita Sampa - recuperação de senha';
                    $mail->Body    = 'Olá, ' . $user->nome . '<br><br>Recebemos sua solicitação de atualização de senha. Para continuar, clique no link a seguir e redefina uma nova senha para sua conta: <br><br> <a href="http://localhost/pt/resetPassword/' . $user->recuperar_senha . '">Clique aqui</a>';
                    $mail->AltBody = 'Olá, ' . $user->nome . '\n\nRecebemos sua solicitação de atualização de senha. Para continuar, clique no link a seguir e redefina uma nova senha para sua conta: \n\nhttp://localhost/pt/resetPassword/'. $user->recuperar_senha;
                
                    $mail->send();
    
                    echo 'E-mail enviado';
                }
                catch (Exception $e) {
                    echo "E-mail não pôde ser enviado. Erro: {$mail->ErrorInfo}";
                }
            }
            else {
                $msgError = "Erro: Falha na solicitação de recuperação de senha. Tente novamente.";
                return redirect()->route('recover.password', app()->getLocale())->with('msgError', $msgError);
            }
        }
        else {
            $msgError = "Erro: Usuário não encontrado. Verifique o e-mail fornecido para recuperação de senha.";
            return redirect()->route('recover.password', app()->getLocale())->with('msgError', $msgError);
        }
    }

    public function resetPassword($language, $key = null)
    {
        if(!empty($key)) {
            $user = new User;
            $user = $user->where('recuperar_senha', $key)->first();
    
            if(!empty($user)) {
                return view('resetPassword', ['key' => $key]);
            }
            else {
                $msgError = "Erro: Link inválido. Solicite um novo link.";
                return redirect()->route('recover.password', app()->getLocale())->with('msgError', $msgError);
            }
        }
        else {
            $msgError = "Erro: Link inválido. Solicite um novo link.";
            return redirect()->route('recover.password', app()->getLocale())->with('msgError', $msgError);
        }
    }

    public function updatePassword(Request $request)
    {
        if(!empty($request->key)) {
            $user = new User;
            $user = $user->where('recuperar_senha', $request->key)->first();

            $user->senha = bcrypt($request->password);
            
            if($user->save()) {
                $user->recuperar_senha = null;
                $user->save();

                $msgLogin = "Sucesso: Sua senha foi atualizada. Entre com sua nova senha.";
                return redirect()->route('login', app()->getLocale())->with('msgLogin', $msgLogin);
            }
            else {
                $msgError = "Erro: Falha na atualização de senha. Tente novamente.";
                return redirect()->route('reset.password', app()->getLocale())->with('msgError', $msgError);
            }
        }
    }
}
