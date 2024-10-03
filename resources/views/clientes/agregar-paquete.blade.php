@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Agregar Paquete a {{ $cliente->name }}</h2>

    <form action="{{ route('clientes.paquete.store', $cliente->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="paquete_id">Selecciona Paquete</label>
            <select name="paquete_id" id="paquete_id" class="form-control" onchange="updatePrice()">
                <option value="">Selecciona un paquete</option>
                @foreach($paquetes as $paquete)
                    <option value="{{ $paquete->id }}" data-price="{{ $paquete->precio }}">{{ $paquete->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="precio_total">Precio</label>
            <input type="text" name="precio_total" id="precio_total" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Agregar Paquete</button>
    </form>
</div>

<script>
function updatePrice() {
    var paqueteSelect = document.getElementById('paquete_id');
    var selectedOption = paqueteSelect.options[paqueteSelect.selectedIndex];
    var price = selectedOption.getAttribute('data-price');
    document.getElementById('precio_total').value = price;
}
</script>
@endsection
