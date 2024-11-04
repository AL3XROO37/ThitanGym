@extends('layouts.app')

@section('content')
<div class="contenedor">
    <h1>Editar Cliente: {{ $cliente->name }}</h1>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver a la lista de clientes</a>
    
    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $cliente->name }}" required>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $cliente->apellido }}">
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->telefono }}">
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $cliente->direccion }}">
        </div>

        <div class="form-group">
            <label for="foto">Foto</label>
            <input type="text" class="form-control" id="foto" name="foto" value="{{ $cliente->foto }}">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
    </form>
</div>
@endsection
