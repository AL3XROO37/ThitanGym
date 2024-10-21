<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use App\Models\Cliente;
use Illuminate\Http\Request;

class VisitaController extends Controller
{
    public function index()
    {
        $visitas = Visita::with('cliente')->get();
        return view('visitas.index', compact('visitas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('visitas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_visita' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i',
        ]);

        Visita::create([
            'cliente_id' => $request->cliente_id,
            'fecha_visita' => $request->fecha_visita,
            'hora_entrada' => $request->hora_entrada,
            'monto_pagado' => 45.00, // Costo fijo de la visita
        ]);

        return redirect()->route('visitas.index')->with('success', 'Visita registrada con éxito.');
    }

    public function edit(Visita $visita)
    {
        $clientes = Cliente::all();
        return view('visitas.edit', compact('visita', 'clientes'));
    }

    public function update(Request $request, Visita $visita)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_visita' => 'required|date',
            'hora_entrada' => 'required|date_format:H:i',

        ]);

        $visita->update($request->all());

        return redirect()->route('visitas.index')->with('success', 'Visita actualizada con éxito.');
    }

    public function destroy(Visita $visita)
    {
        $visita->delete();
        return redirect()->route('visitas.index')->with('success', 'Visita eliminada con éxito.');
    }
}
