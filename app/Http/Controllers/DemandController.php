<?php

namespace App\Http\Controllers;

use App\Demand;
use Illuminate\Http\Request;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $demands = Demand::all();
        return view('demands\create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $demand = new Demand();
        $demand->name = $request->name;
        $demand->slug = $demand->name;
        $demand->time_take = $request->time;
        $demand->date = $request->date;
        $demand->product = $request->product;
        $demand->quantity = $request->quantity;
        $demand->value = $request->value;
        $demand->status = "Aguardando";
        $demand->save();

        return redirect()->route('demand.index')->withStatus("Pedido criado com sucesso!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function show(Demand $demand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function edit(Demand $demand)
    {
        return view('demands\edit', [
            'demand' => $demand
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demand $demand)
    {
        $demand->delete();
        return redirect()->route('demand.index')->withStatus("Pedido excluído com sucesso!");
    }
}
