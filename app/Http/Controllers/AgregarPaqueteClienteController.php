<?php

namespace App\Http\Controllers;

use App\Models\AgregarPaqueteCliente;
use App\Models\Cliente;
use App\Models\Paquete;
use Illuminate\Http\Request;

class AgregarPaqueteClienteController extends Controller
{
    public function index()
    {
        $paquetesClientes = AgregarPaqueteCliente::with(['cliente', 'paquete'])->get();
        return view('agregar_paquete_cliente.index', compact('paquetesClientes'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $paquetes = Paquete::all();
        return view('agregar_paquete_cliente.create', compact('clientes', 'paquetes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'paquete_id' => 'required|exists:paquetes,id',
            'precio_total' => 'required|numeric',
            'clave_acceso' => 'required|unique:agregar_paquete_cliente,clave_acceso',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $paquete = Paquete::find($request->paquete_id);
        $fechaFin = now()->addDays($paquete->duracion_dias);

        AgregarPaqueteCliente::create([
            'cliente_id' => $request->cliente_id,
            'paquete_id' => $request->paquete_id,
            'precio_total' => $request->precio_total,
            'clave_acceso' => $request->clave_acceso,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $fechaFin,
            'estado' => $request->estado,
        ]);

        return redirect()->route('agregar_paquete_cliente.index')->with('success', 'Paquete agregado correctamente.');
    }

    public function edit(AgregarPaqueteCliente $agregarPaqueteCliente)
    {
        $clientes = Cliente::all();
        $paquetes = Paquete::all();
        return view('agregar_paquete_cliente.edit', compact('agregarPaqueteCliente', 'clientes', 'paquetes'));
    }

    public function update(Request $request, AgregarPaqueteCliente $agregarPaqueteCliente)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'paquete_id' => 'required|exists:paquetes,id',
            'precio_total' => 'required|numeric',
            'clave_acceso' => 'required|unique:agregar_paquete_cliente,clave_acceso,' . $agregarPaqueteCliente->id,
            'fecha_inicio' => 'required|date',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $paquete = Paquete::find($request->paquete_id);
        $fechaFin = now()->addDays($paquete->duracion_dias);

        $agregarPaqueteCliente->update([
            'cliente_id' => $request->cliente_id,
            'paquete_id' => $request->paquete_id,
            'precio_total' => $request->precio_total,
            'clave_acceso' => $request->clave_acceso,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $fechaFin,
            'estado' => $request->estado,
        ]);

        return redirect()->route('agregar_paquete_cliente.index')->with('success', 'Paquete actualizado correctamente.');
    }

    public function destroy(AgregarPaqueteCliente $agregarPaqueteCliente)
    {
        $agregarPaqueteCliente->delete();
        return redirect()->route('agregar_paquete_cliente.index')->with('success', 'Paquete eliminado correctamente.');
    }
}
