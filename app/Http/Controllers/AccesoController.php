<?php

namespace App\Http\Controllers;

use App\Models\Acceso;
use App\Models\Cliente;
use App\Models\AgregarPaqueteCliente;
use Illuminate\Http\Request;

class AccesoController extends Controller
{
    public function index()
    {
        $accesos = Acceso::with('cliente')->get();
        $clientes = Cliente::all(); // Obtener todos los clientes
        return view('accesos.index', compact('accesos', 'clientes'));
    }


    public function create()
    {
        return view('accesos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'clave_acceso' => 'required|string|max:255',
        ]);

        // Crear un nuevo acceso
        $acceso = Acceso::create([
            'cliente_id' => $request->cliente_id,
            'clave_acceso' => $request->clave_acceso,
            'fecha_acceso' => now()->format('Y-m-d'),
            'hora_acceso' => now()->format('H:i:s'),
        ]);

        return response()->json([
            'success' => true,
            'acceso' => $acceso,
            'cliente' => $acceso->cliente, // Devuelve también el cliente
        ]);
    }


    public function show(Acceso $acceso)
    {
        // Opcional, si necesitas un método para mostrar detalles de un acceso
    }

    public function edit(Acceso $acceso)
    {
        // Opcional, si necesitas un método para editar accesos
    }

    public function update(Request $request, Acceso $acceso)
    {
        // Opcional, si necesitas un método para actualizar accesos
    }

    public function destroy(Acceso $acceso)
    {
        $acceso->delete();
        return redirect()->route('accesos.index')->with('success', 'Acceso eliminado exitosamente');
    }

    public function fetchClienteData(Request $request)
    {
        $clienteId = $request->input('cliente_id');
        $cliente = Cliente::with(['agregarPaqueteCliente' => function ($query) {
            $query->with('paquete'); // Si necesitas datos del paquete
        }])->find($clienteId);

        return response()->json($cliente);
    }

    public function buscarClientePorClaveAcceso(Request $request)
    {
        $request->validate([
            'clave_acceso' => 'required|string',
        ]);

        $paqueteCliente = AgregarPaqueteCliente::where('clave_acceso', $request->clave_acceso)->with('cliente')->first();

        if ($paqueteCliente) {
            return response()->json([
                'success' => true,
                'cliente' => $paqueteCliente->cliente,
                'estado' => $paqueteCliente->estado,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Clave de acceso no encontrada.']);
    }
}
