@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Nueva Visita</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para crear una visita --}}
    <form action="{{ route('visitas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" class="form-control" required>
                <option value="">Seleccionar cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_visita">Fecha de Visita:</label>
            <input type="date" name="fecha_visita" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="hora_entrada">Hora de Entrada:</label>
            <input type="time" name="hora_entrada" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="monto_pagado">Monto Pagado (MXN):</label>
            <input type="number" name="monto_pagado" class="form-control" value="45" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Visita</button>
    </form>
</div>
@endsection
