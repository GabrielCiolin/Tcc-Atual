<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\AdressClient;



class ClientController extends Controller
{
    public function index()
    {
        $search = request('search');


        if ($search) {
            $clients = Client::with('address')
                ->where('name', 'like', '%' . $search . '%')
                ->get();
        } else {
            $clients = Client::with('address')->get();
        }

        return view('/clients/searchClient', ['clients' => $clients, 'search' => $search]);
    }


    public function create()
    {
        return view('/clients/addClient');
    }

    public function store(Request $request)
    {

        $client = new Client;

        $client->name = $request->name;
        $client->rg = $request->rg;
        $client->cpf = $request->cpf;
        $client->contact = $request->contact;
        $client->save();

        $address = new AdressClient;

        $address->cep = $request->cep;
        $address->place = $request->place;
        $address->number = $request->number;

        $client->address()->save($address);

        return redirect('/client/search');
    }

    public function edit($id)
    {
        $clients = Client::findOrFail($id);

        return view('/clients/editClient', ['clients' => $clients]);
    }


// ClientController.php

public function update(Request $request, $id)
{
    $client = Client::findOrFail($id);

    // Atualiza os dados do cliente
    $client->update([
        'name' => $request->name,
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
            $address = AdressClient::findOrFail($addressData['id']);
            $address->update($addressData);
        }
    }

    return redirect('/client/search')->with('msg', 'Cliente atualizado com sucesso!');
}


    
    //Código antigo para pegar o dado dos clientes e editar
    
    // public function update(Request $request)
    // {
    //     Client::findOrFail($request->id)->update($request->all());

    //     return redirect('/client/search')->with('msg', 'Cliente atualizado com sucesso!');
    // }

    public function destroy($id)
    {
        Client::findOrFail($id)->delete(); // Procura o cliente pelo ID e Deleta
        return redirect('/client/search'); // Retorna pra tela anterior atualizando os registros

    }
}
