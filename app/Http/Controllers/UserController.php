<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Store\File\Reader;
use Hamcrest\Type\IsBoolean;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Models\AdressUser;


class UserController extends Controller
{

    public function index()
    {
        $search = request('search');

        if ($search) {
            $users = User::where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%');
            })->get();
        } else {
            $users = User::all();
        }

        $roles = User::ROLES;

        return view('/users/searchUser', ['users' => $users, 'search' => $search, 'roles' => $roles]); //compact, ver função como funciona
    }

    public function create()
    {
        return view('/users/addUser');
    }

    public function store(Request $request)
    {

        $user = new User;
        // $user->first_name = $request->first_name;
        // $user->last_name = $request->last_name;
        // $user->rg = $request->rg;
        // $user->cpf = $request->cpf;
        // $user->contact = $request->contact;
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->is_admin = $request->is_admin;
        $user->fill($request->all());
        $user->save();

        $address = new AdressUser();

        $address->cep = $request->cep;
        $address->place = $request->place;
        $address->number = $request->number;

        $user->address()->save($address);


        return redirect('/user/search');
    }



    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('/users/editUser', ['users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Atualiza os dados do usuário
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'rg' => $request->rg,
            'cpf' => $request->cpf,
            'contact' => $request->contact,
        ]);

        // Verifica se há endereços a serem atualizados
        if ($request->has('cep')) {
            $addressesData = array_map(function ($index) use ($request) {
                return [
                    'id' => $request->address_id[$index], // Obtem o ID do endereço a partir do campo oculto
                    'cep' => str_replace('-', '', $request->cep[$index]), // Remover o traço do CEP
                    'place' => $request->place[$index],
                    'number' => $request->number[$index],
                ];
            }, array_keys($request->cep));

            foreach ($addressesData as $addressData) {
                // Busca o endereço pelo ID e atualiza os dados
                $address = AdressUser::findOrFail($addressData['id']);
                $address->update($addressData);
            }
        }

        return redirect('/user/search')->with('msg', 'Usuário atualizado com sucesso!');
    }
    // public function update(Request $request)
    // {
    //     User::findOrFail($request->id)->update($request->all());
    //     return redirect('/user/search')->with('msg', 'Usuário atualizado com sucesso!');
    // }

    public function destroy($id)
    {
        User::findOrFail($id)->delete(); // Procura o usuário pelo ID e Deleta
        return redirect('/user/search'); // Retorna pra tela anterior atualizando os registros

    }
}
