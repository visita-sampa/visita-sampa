<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;


class LoginController extends Controller
{

    public function login()
    {
        if (Auth::user())
            return redirect()->route('user', app()->getLocale());
        else
            return view('login');

        // return view('user');
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

        if (!empty($findUser) && Hash::check($request->passwordLogin, $findUser->senha)) {
            Auth::loginUsingId($findUser->id_usuario);
        }

        return redirect()->route('login', app()->getLocale());
    }
}
