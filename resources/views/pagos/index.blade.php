@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pagos</h1>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pagos.create') }}" class="btn btn-primary">Registrar Nuevo Pago</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Paquete</th>
                <th>Monto Pagado</th>
                <th>Monto Pendiente</th>
                <th>Fecha de Pago</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pagos as $pago)
                <tr>
                    <td>{{ $pago->cliente->name }}</td>
                    <td>{{ $pago->paquete->nombre }}</td>
                    <td>{{ $pago->monto_pagado }}</td>
                    <td>{{ $pago->monto_pendiente }}</td>
                    <td>{{ $pago->fecha_pago }}</td>
                    <td>{{ $pago->estado }}</td>
                    <td>
                        <a href="{{ route('pagos.edit', $pago) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('pagos.destroy', $pago) }}" method="POST" style="display:inline;">
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
