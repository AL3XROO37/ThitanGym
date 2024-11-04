@extends('layouts.app')

@section('content')

<div class="contenedor-crud">


    <h1>Paquetes</h1>
    <a href="{{ route('paquetes.create') }}" class="btn btn-primary">Nuevo Paquete</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Duración (días)</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paquetes as $paquete)
                <tr>
                    <td data-label="Nombre">{{ $paquete->nombre }}</td>
                    <td data-label="Precio">{{ $paquete->precio }}</td>
                    <td data-label="Duracion-Dias">{{ $paquete->duracion_dias }}</td>
                    <td data-label="Descripcion">{{ $paquete->descripcion }}</td>
                    <td data-label="Acciones">
                        <a href="{{ route('paquetes.edit', $paquete->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('paquetes.destroy', $paquete->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este paquete?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
