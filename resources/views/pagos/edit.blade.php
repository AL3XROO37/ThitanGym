@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Pago</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pagos.update', $pago) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" class="form-control" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $pago->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->name }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="paquete_id">Paquete:</label>
            <select name="paquete_id" class="form-control" required>
                @foreach($paquetes as $paquete)
                    <option value="{{ $paquete->id }}" {{ $pago->paquete_id == $paquete->id ? 'selected' : '' }}>{{ $paquete->nombre }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="monto_pagado">Monto Pagado:</label>
            <input type="number" step="0.01" name="monto_pagado" class="form-control" value="{{ $pago->monto_pagado }}" required>
        </div>

        <div class="form-group">
            <label for="monto_pendiente">Monto Pendiente:</label>
            <input type="number" step="0.01" name="monto_pendiente" class="form-control" value="{{ $pago->monto_pendiente }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_pago">Fecha de Pago:</label>
            <input type="date" name="fecha_pago" class="form-control" value="{{ $pago->fecha_pago }}" required>
        </div>
    
        <button type="submit" class="btn btn-primary">Actualizar Pago</button>
    </form>
</div>
@endsection
