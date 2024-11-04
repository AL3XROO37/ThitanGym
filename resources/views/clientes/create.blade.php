@extends('layouts.app')

@section('content')
<div class="contenedor">
    <h1>Agregar Cliente</h1>

    <a href="{{ route('clientes.index') }}" class="btn btn-secondary mt-3">Volver a la lista de clientes</a>
   
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido">
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono">
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion">
        </div>

        <div class="form-group">
            <label for="foto">Foto</label>
            <input type="text" class="form-control" id="foto" name="foto">
        </div>

        <button type="submit" class="btn btn-primary">Agregar Cliente</button>
    </form>

</div>
@endsection
