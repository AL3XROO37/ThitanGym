@extends('layouts.app')

@section('content')
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
                    <td>{{ $paquete->nombre }}</td>
                    <td>{{ $paquete->precio }}</td>
                    <td>{{ $paquete->duracion_dias }}</td>
                    <td>{{ $paquete->descripcion }}</td>
                    <td>
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
@endsection
