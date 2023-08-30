<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Str;
use App\Models\AdressClient;
use App\Models\AdressUser;

use function PHPSTORM_META\type;

class CallController extends Controller
{

    public function index()
    {
        $calls = Call::all();
        $calls = Call::with(['client.address'])->get();
        return view('/calls/listCall', compact('calls')); // Passar os chamados para a viewPassar os chamados para a view

    }

    public function create(Request $request)
    {
        $query = $request->query();

        $isUser = $query['type'] == Str::of(User::class)->classBasename();
        $isClient = $query['type'] == Str::of(Client::class)->classBasename();

        if ($isUser) {
            $result = User::findOrFail($query['result_id']);
        } elseif ($isClient) {
            $result = Client::with('address')->findOrFail($query['result_id']);
        }
        $users = User::all();
        return view('/calls/addCall', compact('result', 'users'));
    }


    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
            'technician_id' => 'nullable|exists:users,id',
            'result_type' => 'required|string',
            'date_finalized' => 'nullable|date',
            'service_type' => 'required|string',
            'description_call' => 'required|string',
            'comments' => 'nullable|string',
        ];

        $isUser = $request->get('result_type') == Str::of(User::class)->classBasename();
        $isClient = $request->get('result_type') == Str::of(Client::class)->classBasename();

        if ($isUser) {
            $rules['client_id'] = 'required|exists:users,id';
        } elseif ($isClient) {
            $rules['client_id'] = 'required|exists:clients,id';
        }


        $validatedData = $request->validate($rules);

        $call = new Call();
        $call->user_id = $validatedData['user_id'];
        $call->client_id = $validatedData['client_id'];
        $call->technician_id = $validatedData['technician_id'];
        $call->client_type = $validatedData['result_type'];
        $call->date_finalized = null;
        $call->service_type = $validatedData['service_type'];
        $call->description_call = $validatedData['description_call'];
        $call->comments = $validatedData['comments'];

        $call->save();

        return redirect('/call/index');
    }


    public function search(Request $request)
    {
        $query = $request->input('search');

        if (!$query) {
            return view('/calls/call', ['results' => [], 'query' => '']);;
        }

        $users = User::where('first_name', 'like', "%$query%")
            ->orWhere('last_name', 'like', "%$query%")
            ->get();

        $clients = Client::where('name', 'like', "%$query%")
            ->get();


        $results = $users->concat($clients);

        return view('/calls/call', ['results' => $results, 'query' => $query]);
    }

    public function showTechnician()
    {
        $users = User::all();
        return view('/calls/addCall', ['users' => $users]);
    }

    public function addComment(Request $request, $id)
    {
        $call = Call::findOrFail($id);

        $request->validate([
            'comments' => 'required|string',
        ]);

        $call->comments .= "\n" . $request->comments; // Acrescenta as novas observações

        $call->save();

        return redirect()->back()->with('msg', 'Observações adicionadas com sucesso!');
    }
}
