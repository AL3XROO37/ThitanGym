@extends('layouts.app')

@section('content')
<div class="contenedor-crud">
    <h1>Asignaciones de Paquetes a Clientes</h1>
    <a href="{{ route('agregar_paquete_cliente.create') }}" class="btn btn-primary">Asignar Paquete</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Paquete</th>
                <th>Monto</th>
                <th>Clave de Acceso</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
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
                        <a href="{{ route('agregar_paquete_cliente.edit', $paqueteCliente->id) }}" class="btn btn-warning"><i class='bx bx-edit-alt' ></i></a>
                        <form action="{{ route('agregar_paquete_cliente.destroy', $paqueteCliente->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
