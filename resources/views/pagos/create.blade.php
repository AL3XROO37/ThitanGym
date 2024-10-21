@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Pago</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pagos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" class="form-control" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="paquete_id">Paquete:</label>
            <select name="paquete_id" class="form-control" required>
                @foreach($paquetes as $paquete)
                    <option value="{{ $paquete->id }}">{{ $paquete->nombre }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="monto_pagado">Monto Pagado:</label>
            <input type="number" step="0.01" name="monto_pagado" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="monto_pendiente">Monto Pendiente:</label>
            <input type="number" step="0.01" name="monto_pendiente" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="fecha_pago">Fecha de Pago:</label>
            <input type="date" name="fecha_pago" class="form-control" required>
        </div>
    
        <button type="submit" class="btn btn-primary">Registrar Pago</button>
    </form>
</div>
@endsection
