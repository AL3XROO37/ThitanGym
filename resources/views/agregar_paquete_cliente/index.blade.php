@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Paquetes de Clientes</h1>
    <a href="{{ route('agregar_paquete_cliente.create') }}" class="btn btn-primary">Agregar Paquete</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Paquete</th>
                <th>Precio Total</th>
                <th>Clave de Acceso</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paquetesClientes as $paqueteCliente)
            <tr>
                <td>{{ $paqueteCliente->id }}</td>
                <td>{{ $paqueteCliente->cliente->name }}</td>
                <td>{{ $paqueteCliente->paquete->nombre }}</td>
                <td>{{ $paqueteCliente->precio_total }}</td>
                <td>{{ $paqueteCliente->clave_acceso }}</td>
                <td>{{ $paqueteCliente->fecha_inicio }}</td>
                <td>{{ $paqueteCliente->fecha_fin }}</td>
                <td>{{ $paqueteCliente->estado }}</td>
                <td>
                    <a href="{{ route('agregar_paquete_cliente.edit', $paqueteCliente) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('agregar_paquete_cliente.destroy', $paqueteCliente) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
