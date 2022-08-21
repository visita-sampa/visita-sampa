<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::user()) {
            return redirect()->route('login', app()->getLocale());
        }

        $profile = DB::table('classificacao_perfil_roteiro')
            ->where('id_classificacao', Auth::user()->fk_classificacao_perfil_roteiro_id_classificacao)
            ->get();

        $publications = DB::table('publicacao')->where('fk_usuario_id_usuario', Auth::user()->id_usuario)
            ->orderBy('id_publicacao', 'desc')
            ->paginate(12);

            if($request->ajax()) {
                $view = view('userPublication', ['publications' => $publications])->render();
                return response()->json(['html'=>$view]);
            }

        return view('user',  ['profile' => $profile, 'publications' => $publications]);
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
                $mail->addAddress($request->emailSignup, $request->nameSignup);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Visita Sampa - confirmação de e-mail';
                $mail->Body    = 'Olá, ' . $request->nameSignup . '<br><br>Agradecemos a sua visita em nosso site! Para finalizar seu cadastro, confirme seu endereço de e-mail clicando no link abaixo: <br><br> <a href="http://localhost/pt/emailConfirmation/' . $user->chave_confirmacao . '">Clique aqui</a>';
                $mail->AltBody = 'Olá, ' . $request->nameSignup . '\n\nAgradecemos a sua visita em nosso site! Para finalizar seu cadastro, confirme seu endereço de e-mail clicando no link abaixo: \n\nhttp://localhost/pt/emailConfirmation/'. $user->chave_confirmacao;
            
                $mail->send();

                echo 'Message has been sent';
            }
            catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            $findUser = $user->where('email', $request->emailSignup)->first();

            // if (!empty($findUser) && Hash::check($request->passwordSignup, $findUser->senha)) {
            //     Auth::loginUsingId($findUser->id_usuario);
            // }
        }
        return redirect()->route('login', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    // public function show(user $user)
    // {
    //     //
    // }

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
    // public function update(Request $request, user $user)
    // {
    //     //
    // }

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

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('login');
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

    // public function validatePassword($password)
    // {
    //     // if((strlen($password) >= 8) && (filter_var($password, FILTER_SANITIZE_NUMBER_INT) == true))
    //     $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d].\S{8,36}$/';

    //     return preg_match($pattern, $password) ? true : false;
    // }

    public function emailConfirmation($language, $key = null)
    {
        if(!empty($key)) {
            $findUser = DB::table('usuario')->where('chave_confirmacao', $key)->value('id_usuario');

            if(!empty($findUser)) {

                $confirm = DB::table('usuario')
                ->where('id_usuario', $findUser)
                ->update(['situacao_cadastro' => 1]);

                DB::table('usuario')
                ->where('id_usuario', $findUser)
                ->update(['email_verified_at' => now()]);

                DB::table('usuario')
                ->where('id_usuario', $findUser)
                ->update(['chave_confirmacao' => null]);

                if($confirm) {
                    $msgSignup = "Sucesso: E-mail confirmado.";
                    return redirect()->route('login', app()->getLocale())->with('msgSignup', $msgSignup);
                }
                else {
                    $msgError = "Erro: E-mail não confirmado.";
                    return view('emailConfirmation', ['msgError' => $msgError]);
                }

            }
            else {
                $msgError = "Erro: Endereço inválido.";
                return view('emailConfirmation', ['msgError' => $msgError]);
            }
        }
        else {
            $msgError = "Erro: Endereço inválido.";
            return view('emailConfirmation', ['msgError' => $msgError]);
        }
    }
    
    public function emailConfirmationFail()
    {
        return view('emailConfirmation');
    }

    public function crop(Request $request)
    {
        $response = cloudinary()->upload($request->file('profile-pic')->getRealPath())->getSecurePath();

        $user = Auth::user();

        User::where('id_usuario', $user->id_usuario)->update(['foto_perfil' => $response]);

        return response()->json(['status' => 1, 'msg' => 'Sua foto de perfil foi atualizada com sucesso.', 'name' => $response]);
    }
}
