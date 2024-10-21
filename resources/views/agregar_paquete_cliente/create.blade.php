@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asignar Paquete a Cliente</h1>

    {{-- Mostrar mensajes de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para crear la asignación --}}
    <form action="{{ route('agregar_paquete_cliente.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="searchCliente">Buscar Cliente:</label>
            <input type="text" id="searchCliente" class="form-control" placeholder="Buscar cliente...">

            <label for="cliente_id" style="margin-top: 15px;">Cliente:</label>
            <select name="cliente_id" id="clienteSelect" class="form-control" required>
                <option value="" disabled selected>Seleccione un cliente</option> <!-- Opción vacía -->
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
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="precio_total">Precio Total:</label>
            <input type="text" name="precio_total" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Paquete</button>
    </form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchCliente');
        const clienteSelect = document.getElementById('clienteSelect');

        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();
            const options = clienteSelect.options;

            for (let i = 0; i < options.length; i++) {
                const optionText = options[i].text.toLowerCase();
                if (optionText.includes(filter)) {
                    options[i].style.display = '';
                } else {
                    options[i].style.display = 'none';
                }
            }
        });
    });
</script>
