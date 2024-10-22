@extends('layouts.app')

@section('content')

<div class="contenedor-crud">


    <h1>Lista de Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary mb-3">Agregar Cliente</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr class="tr-hover">
                    <td data-label="ID">{{ $cliente->id }}</td>
                    <td data-label="Nombre">{{ $cliente->name }}</td>
                    <td data-label="Apellido">{{ $cliente->apellido }}</td>
                    <td data-label="Teléfono">{{ $cliente->telefono }}</td>
                    <td data-label="Dirección">{{ $cliente->direccion }}</td>
                    <td data-label="Foto"><img src="{{ asset('storage/' . $cliente->foto) }}" alt="Foto"></td>
                    <td data-label="Acciones">
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning"><i class='bx bx-edit-alt' ></i></a>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class='bx bx-trash'></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>    
    </table>

</div>
@endsection
