<?php

namespace App\Http\Controllers;

use App\Client;
use App\Demand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::all();

        return view('clients\index', [
            'clients' => $clients
        ]);
    }

    public function create()
    {
        $clients = Client::all();
        return view('clients/create');
    }

    public function store(Request $request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->slug = $request->name;
        $client->date_birth = $request->date_birth;
        $client->phone = $request->phone;
        $client->city = $request->city;
        $client->neighborhood = $request->neighborhood;
        $client->address = $request->address . " - " . $request->number;
        $client->save();

        return redirect()->route('client.index')->withStatus("Cliente criado com sucesso!");
    }

    public function show(Client $client)
    {
        //
    }

    public function edit(Client $client)
    {
        return view('clients/edit', [
            'client' => $client
        ]);
    }

    public function update(Request $request, Client $client)
    {
        //
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('client.index')->withStatus("Cliente excluído com sucesso!");
    }

    public function autocomplete(Request $request){
        if($request->ajax()) {
            $clients = Client::where('name', 'LIKE', '%'.$request->client.'%')->get();
            $output = '';
            if (count($clients)>0) {
                $output = '<datalist id="clients">';
                foreach ($clients as $client){
                    $output .= '<option value="'.$client->name.'">';
                }
                $output .= '</datalist>';
            }
            else {
                return;
            }
            return $output;
        } 
    }
}
