<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;


class CallController extends Controller
{

    public function index() {
        
    }

    public function create()
    {
        return view('/calls/addCall');
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
}
