<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Cliente;
use App\Models\Paquete;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with(['cliente', 'paquete'])->get();
        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $paquetes = Paquete::all();
        return view('pagos.create', compact('clientes', 'paquetes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'paquete_id' => 'required|exists:paquetes,id',
            'monto_pagado' => 'required|numeric|min:0',
            'monto_pendiente' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date',
        ]);

        Pago::create($validatedData);

        return redirect()->route('pagos.index')->with('success', 'Pago registrado exitosamente');
    }

    public function edit(Pago $pago)
    {
        $clientes = Cliente::all();
        $paquetes = Paquete::all();
        return view('pagos.edit', compact('pago', 'clientes', 'paquetes'));
    }

    public function update(Request $request, Pago $pago)
    {
        $validatedData = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'paquete_id' => 'required|exists:paquetes,id',
            'monto_pagado' => 'required|numeric|min:0',
            'monto_pendiente' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date',
        ]);

        $pago->update($validatedData);

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado exitosamente');
    }

    public function destroy(Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index')->with('success', 'Pago eliminado exitosamente');
    }
}

