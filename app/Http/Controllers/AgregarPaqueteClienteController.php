<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use App\Models\AgregarPaqueteCliente;
use App\Models\Cliente;
use App\Models\Paquete;
use Illuminate\Http\Request;

class AgregarPaqueteClienteController extends Controller
{
    public function index()
    {
        // Obtener la fecha actual
        $now = now();

        // Actualizar el estado a 'inactivo' si la fecha_fin ha expirado o es igual a la fecha actual
        AgregarPaqueteCliente::where('fecha_fin', '<=', $now)
            ->update(['estado' => 'inactivo']);

        // Actualizar el estado a 'activo' si la fecha_fin es mayor que la fecha actual
        AgregarPaqueteCliente::where('fecha_fin', '>=', $now)
            ->update(['estado' => 'activo']);

        // Obtener todos los registros de la tabla agregar_paquete_cliente, incluyendo relaciones
        $paquetesClientes = AgregarPaqueteCliente::with(['cliente', 'paquete'])->get();
        return view('agregar_paquete_cliente.index', compact('paquetesClientes'));
    }

    public function create()
    {
        // Obtener clientes y paquetes para el formulario
        $clientes = Cliente::all();
        $paquetes = Paquete::all();
        return view('agregar_paquete_cliente.create', compact('clientes', 'paquetes'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'paquete_id' => 'required|exists:paquetes,id',
            'fecha_inicio' => 'required|date',
            'precio_total' => 'required|numeric',
        ]);

        $validatedData['clave_acceso'] = $this->generateUniqueKey();

        // Crear el registro
        AgregarPaqueteCliente::create($validatedData);

        return redirect()->route('agregar_paquete_cliente.index')->with('success', 'Paquete asignado exitosamente');
    }

    // Método para generar una clave única
    private function generateUniqueKey($length = 10)
    {
        do {
            $key = mt_rand(1000000000, 9999999999); // Genera un número aleatorio de 10 dígitos
        } while (AgregarPaqueteCliente::where('clave_acceso', $key)->exists()); // Asegura que la clave sea única

        return $key;
    }


    public function edit($id)
    {
        $agregarPaqueteCliente = AgregarPaqueteCliente::findOrFail($id);
        $clientes = Cliente::all(); // Obtén todos los clientes
        $paquetes = Paquete::all(); // Obtén todos los paquetes

        return view('agregar_paquete_cliente.edit', compact('agregarPaqueteCliente', 'clientes', 'paquetes'));
    }

    // Método para actualizar el registro
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'paquete_id' => 'required|exists:paquetes,id',
            'precio_total' => 'required|numeric',
            'clave_acceso' => 'required|unique:agregar_paquete_cliente,clave_acceso,' . $id,
            'fecha_inicio' => 'required|date',
        ]);

        $agregarPaqueteCliente = AgregarPaqueteCliente::findOrFail($id);
        $agregarPaqueteCliente->fill($validatedData);

        // Este paso llamará a la lógica del modelo para calcular la fecha_fin
        $agregarPaqueteCliente->save();

        return redirect()->route('agregar_paquete_cliente.index')->with('success', 'Paquete actualizado exitosamente');
    }


    public function destroy($id)
    {
        // Eliminar la asignación
        $paqueteCliente = AgregarPaqueteCliente::findOrFail($id);
        $paqueteCliente->delete();

        return redirect()->route('agregar_paquete_cliente.index')->with('success', 'Asignación de paquete eliminada correctamente.');
    }

    
}
