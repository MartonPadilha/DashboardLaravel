<?php

namespace App\Http\Controllers;

use App\UM;
use Illuminate\Http\Request;

class UMController extends Controller
{
    public function index()
    {
        $um = UM::all();

        return view('um.index', [
            'um' => $um
        ]);
    }

    public function create()
    {
        $um = UM::all();
        return view('um.create', [
            'um' => $um
        ]);
    }

    public function store(Request $request)
    {
        $um = new UM();
        $um->initials = $request->initials;
        $um->description = $request->description;
        $um->save();

        return redirect()->route('um.index')->with('create', 'Unidade de medida '. $um->initials .' criada!');
    }

    public function show($id)
    {
        //
    }

    public function edit(UM $um)
    {
        return view('um.edit', [
            'um' => $um
        ]);
    }

    public function update(Request $request, UM $um)
    {
        $um->initials = $request->initials;
        $um->description = $request->description;
        $um->save();

        return redirect()->route('um.index')->with('edit', 'Unidade de medida '. $um->initials .' editada!');

    }

    public function destroy(UM $um)
    {
        $um->delete();
        return redirect()->route('um.index')->with('delete', 'Unidade de medida '. $um->initials .' deletada!');
    }
}
