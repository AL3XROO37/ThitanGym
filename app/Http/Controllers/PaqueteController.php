<?php

namespace App\Http\Controllers;

use App\Models\Paquete;
use Illuminate\Http\Request;

class PaqueteController extends Controller
{
    public function index()
    {
        $paquetes = Paquete::all();
        return view('paquetes.index', compact('paquetes'));
    }

    public function create()
    {
        return view('paquetes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric|min:0',
            'duracion_dias' => 'required|integer|min:1',
            'descripcion' => 'nullable',
        ]);

        Paquete::create($request->all());
        return redirect()->route('paquetes.index')->with('success', 'Paquete creado correctamente');
    }

    public function edit(Paquete $paquete)
    {
        return view('paquetes.edit', compact('paquete'));
    }

    public function update(Request $request, Paquete $paquete)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric|min:0',
            'duracion_dias' => 'required|integer|min:1',
            'descripcion' => 'nullable',
        ]);

        $paquete->update($request->all());
        return redirect()->route('paquetes.index')->with('success', 'Paquete actualizado correctamente');
    }

    public function destroy(Paquete $paquete)
    {
        $paquete->delete();
        return redirect()->route('paquetes.index')->with('success', 'Paquete eliminado correctamente');
    }
}
