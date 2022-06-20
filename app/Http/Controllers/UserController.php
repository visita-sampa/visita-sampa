<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()) {
            return redirect()->route('login', app()->getLocale());
        }

        $profile = DB::table('classificacao_perfil_roteiro')
            ->where('id_classificacao', Auth::user()->fk_classificacao_perfil_roteiro_id_classificacao)
            ->get();

        $publications = DB::table('publicacao')->where('fk_usuario_id_usuario', Auth::user()->id_usuario)
            ->orderBy('id_publicacao', 'desc')
            ->get();

        return view('user',  ['profile' => $profile, 'publications' => $publications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
        // $validatePassword = $this->validatePassword($request->passwordSignup);
        $validateCredencials = $this->validateCredentials($user);

        // if ($validateCredencials && $validatePassword) {
        if ($validateCredencials) {
            $user->save();

            $findUser = $user->where('email', $request->emailSignup)->first();

            if (!empty($findUser) && Hash::check($request->passwordSignup, $findUser->senha)) {
                Auth::loginUsingId($findUser->id_usuario);
            }
        }
        return redirect()->route('login', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }

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

    public function validatePassword($password)
    {
        // if((strlen($password) >= 8) && (filter_var($password, FILTER_SANITIZE_NUMBER_INT) == true))
        $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d].\S{8,36}$/';

        return preg_match($pattern, $password) ? true : false;
    }

    public function registerLogin()
    {
    }

    public function crop(Request $request)
    {
        $response = cloudinary()->upload($request->file('profile-pic')->getRealPath())->getSecurePath();

        $user = Auth::user();

        User::where('id_usuario', $user->id_usuario)->update(['foto_perfil' => $response]);

        return response()->json(['status' => 1, 'msg' => 'Sua foto de perfil foi atualizada com sucesso.', 'name' => $response]);
    }
}
