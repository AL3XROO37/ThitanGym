@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Visita</h1>

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

    {{-- Formulario para editar la visita --}}
    <form action="{{ route('visitas.update', $visita->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" class="form-control" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $visita->cliente_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_visita">Fecha de Visita:</label>
            <input type="date" name="fecha_visita" class="form-control" value="{{ $visita->fecha_visita }}" required>
        </div>

        <div class="form-group">
            <label for="hora_entrada">Hora de Entrada:</label>
            <input type="time" name="hora_entrada" class="form-control" value="{{ $visita->hora_entrada }}" required>
        </div>

        <div class="form-group">
            <label for="monto_pagado">Monto Pagado (MXN):</label>
            <input type="number" name="monto_pagado" class="form-control" value="{{ $visita->monto_pagado }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Visita</button>
    </form>
</div>
@endsection
