@extends('layouts.app')

@section('content')
<div class="contenedor">

    <h1>Crear Paquete</h1>

    <a href="{{ route('paquetes.index') }}" class="btn btn-secondary mt-3">Volver a la lista de paquetes</a>
 
    <form action="{{ route('paquetes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" value="{{ old('precio') }}" required>
        </div>

        <div class="form-group">
            <label for="duracion_dias">Duración (días)</label>
            <input type="number" class="form-control" id="duracion_dias" name="duracion_dias" value="{{ old('duracion_dias') }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Crear Paquete</button>
    </form>
       
</div>
@endsection
