@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Paquete de Cliente</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('agregar_paquete_cliente.update', $agregarPaqueteCliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" class="form-control" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $cliente->id == $agregarPaqueteCliente->cliente_id ? 'selected' : '' }}>
                        {{ $cliente->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="paquete_id">Paquete:</label>
            <select name="paquete_id" class="form-control" required>
                @foreach($paquetes as $paquete)
                    <option value="{{ $paquete->id }}" {{ $paquete->id == $agregarPaqueteCliente->paquete_id ? 'selected' : '' }}>
                        {{ $paquete->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ $agregarPaqueteCliente->fecha_inicio }}" required>
        </div>

        <div class="form-group">
            <label for="precio_total">Precio Total:</label>
            <input type="text" name="precio_total" class="form-control" value="{{ $agregarPaqueteCliente->precio_total }}" required>
        </div>

        <div class="form-group">
            <label for="clave_acceso">Clave de Acceso:</label>
            <input type="text" name="clave_acceso" class="form-control" value="{{ $agregarPaqueteCliente->clave_acceso }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Paquete</button>
    </form>
</div>
@endsection
