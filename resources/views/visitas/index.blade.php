@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Visitas</h1>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Botón para crear una nueva visita --}}
    <a href="{{ route('visitas.create') }}" class="btn btn-primary mb-3">Registrar Visita</a>

    {{-- Tabla de visitas --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha de Visita</th>
                <th>Hora de Entrada</th>
                <th>Monto Pagado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitas as $visita)
                <tr>
                    <td>{{ $visita->id }}</td>
                    <td>{{ $visita->cliente->name }}</td>
                    <td>{{ $visita->fecha_visita }}</td>
                    <td>{{ $visita->hora_entrada }}</td>
                    <td>{{ $visita->monto_pagado }} MXN</td>
                    <td>
                        <a href="{{ route('visitas.edit', $visita->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('visitas.destroy', $visita->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta visita?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
