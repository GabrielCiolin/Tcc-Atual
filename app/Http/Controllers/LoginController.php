<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';

        if ($request->get('erro') == 1) {
            $erro = 'Usuário ou senha inválidos!';
            Session::flash('erro', $erro);
        }

        if ($request->get('erro') == 2) {
            $erro = 'Usuário precisa realizar o login para acessar a página!';
            Session::flash('erro', $erro);
        }
        return view('login', ['title' => 'Login']);
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

        if ($exist) { // Verifique se o objeto $exist não é nulo
            $validCredentials = Hash::check($password, $exist->password);
        
            if ($validCredentials) {
                session([
                    'name' => $exist->first_name,
                    'email' => $exist->email,
                    'user_id'=>$exist->id,
                    'is_admin' => $exist->is_admin,
                ]);
        
                return redirect()->route('client.index');
            } else {
                return redirect()->route('login.index', ['erro' => 1])->with('error', 'Usuário ou senha inválidos!');
                ;
            }
        } else {
            return redirect()->route('login.index', ['erro' => 2])->with('error', 'Usuário ou senha inválidos!');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login.login');
    }
}
