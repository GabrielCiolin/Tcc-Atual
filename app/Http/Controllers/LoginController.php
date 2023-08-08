<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';

        if ($request->get('erro') == 1) {
            $erro = 'Usuário ou senha inválidos!';
        }

        if ($request->get('erro') == 2) {
            $erro = 'Usuário precisa realizar o login para acessar a página!';
        }
        return view('login', ['title' => 'Login', 'erro' => $erro]);
    }

    public function authenticate(Request $request)
    {
        $rules = [
            'email' => 'email',
            'password' => 'required'
        ];

        $feedback = [
            'email.email' => 'O campo de E-mail é obrigatório',
            'password.required' => 'O campo da senha é obrigatório'
        ];

        $request->validate($rules, $feedback);

        $email = $request->get('email');
        $password = $request->get('password');

        $user = new User();

        $exist = $user->where('email', $email)->get()->first();

        $validCredentials = Hash::check($password, $exist->password);

        if ($validCredentials) {

            session([
                'name' => $exist->first_name,
                'email' => $exist->email,
                'is_admin' => $exist->is_admin
            ]);



                return redirect()->route('client.index');
        } else {
            return redirect()->route('login.index', ['erro' => 1]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login.login');
    }
}
