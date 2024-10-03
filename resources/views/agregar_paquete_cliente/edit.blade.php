@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Paquete de Cliente</h1>

    <form action="{{ route('agregar_paquete_cliente.update', $agregarPaqueteCliente) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="cliente_id">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control" required>
                <option value="">Seleccionar Cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $agregarPaqueteCliente->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="paquete_id">Paquete</label>
            <select name="paquete_id" id="paquete_id" class="form-control" required>
                <option value="">Seleccionar Paquete</option>
                @foreach($paquetes as $paquete)
                    <option value="{{ $paquete->id }}" {{ $agregarPaqueteCliente->paquete_id == $paquete->id ? 'selected' : '' }}>{{ $paquete->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="precio_total">Precio Total</label>
            <input type="number" name="precio_total" id="precio_total" class="form-control" value="{{ $agregarPaqueteCliente->precio_total }}" required>
        </div>

        <div class="form-group">
            <label for="clave_acceso">Clave de Acceso</label>
            <input type="text" name="clave_acceso" id="clave_acceso" class="form-control" value="{{ $agregarPaqueteCliente->clave_acceso }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $agregarPaqueteCliente->fecha_inicio }}" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="activo" {{ $agregarPaqueteCliente->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $agregarPaqueteCliente->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Paquete</button>
    </form>
</div>
@endsection
