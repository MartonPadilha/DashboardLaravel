<?php

namespace App\Http\Controllers;

use App\Client;
use App\Demand;
use App\Product;
use Illuminate\Http\Request;

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
        $demand->name = $request->autoclient;
        // $demand->slug = $demand->name;
        $demand->time_take = $request->time;
        $demand->date = $request->date;
        // $demand->product = $request->product;
        // $demand->quantity = $request->quantity;
        // $demand->value = $request->value;
        // $demand->status = "Aguardando";
        // $demand->save();
        dd($demand->time_take);

        // return redirect()->route('demand.index')->withStatus("Pedido criado com sucesso!");
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
