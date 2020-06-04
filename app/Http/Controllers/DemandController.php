<?php

namespace App\Http\Controllers;

use App\Client;
use App\Demand;
use App\Product;
use App\ProductDemand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandController extends Controller
{

    public function index()
    {
        $demands = Demand::all();

        return view('demands\index', [
            'demands' => $demands
        ]);
    }

    public function demands(){
        $demands = Demand::all();

        return view('dashboard', [
            'demands' => $demands
        ]);
    }

    public function create()
    {
        $demands = Demand::all();
        $clients = Client::all();
        $products = Product::all();

        return view('demands\create', [
            'demand' => $demands,
            'clients' => $clients,
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        
        $demand = new Demand();
        $demand->id_client = 10000;
        $clients = Client::all();
            foreach($clients as $client){
                if ($client['name'] == $request->client ) {
                    $demand->id_client = (int)$client['id'];
                } 
            }
        $demand->id_user = Auth::user()->id;
        $demand->slug = $request->client;
        $demand->time_take = $request->time;
        $demand->date = $request->date;
        $demand->quantity = 0;
        $demand->value = $request->total_demand;
        $demand->status = "Aguardando";
        $demand->save();
        
        foreach($request->list as $product){
            for($i = 0; $i < $product['quantity']; $i++){
                $demand->products()->attach($product['product']);
                }
            }
                     
        $suc['success'] = true;
        echo json_encode($suc);
        return;
    }

    public function show(Demand $demand)
    {
        //
    }

    public function edit(Demand $demand)
    {
        return view('demands\edit', [
            'demand' => $demand
        ]);
    }

    public function update(Request $request, Demand $demand)
    {
        if ($request->name == '') {
            $demand->status = "Entregue";
            $demand->save();
    
            return redirect()->route('demand.index')->withStatus("Pedido entregue com sucesso!");
        } else {
            $demand->name = $request->name;
            $demand->slug = $demand->name;
            $demand->time_take = $request->time;
            $demand->date = $request->date;
            $demand->product = $request->product;
            $demand->quantity = $request->quantity;
            $demand->value = $request->value;
            $demand->status = "Aguardando";
            $demand->save();
    
            return redirect()->route('demand.index')->withStatus("Pedido editado com sucesso!");
        }
    }

    public function destroy(Demand $demand)
    {
        $demand->delete();
        return redirect()->route('demand.index')->withStatus("Pedido excluído com sucesso!");
    }
}
