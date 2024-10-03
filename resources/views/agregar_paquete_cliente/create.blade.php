@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Agregar Paquete a Cliente</h1>

        <form action="{{ route('agregar_paquete_cliente.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cliente_id">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-control" required>
                    <option value="">Seleccionar Cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="paquete_id">Paquete</label>
                <select name="paquete_id" id="paquete_id" class="form-control" required>
                    <option value="">Seleccionar Paquete</option>
                    @foreach($paquetes as $paquete)
                        <option value="{{ $paquete->id }}">{{ $paquete->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="precio_total">Precio Total</label>
                <input type="number" name="precio_total" id="precio_total" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="clave_acceso">Clave de Acceso</label>
                <input type="text" name="clave_acceso" id="clave_acceso" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Agregar Paquete</button>
        </form>
    </div> 
@endsection 