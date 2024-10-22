{{-- Archivo: resources/views/admin/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Sección principal, puedes agregar más cosas aquí -->
            <div class="col-left">
                <h1>Graficas</h1>

                <h3>Ventas los ultimos 5 meses</h3>
                <canvas id="ventasChart" width="400" height="200"></canvas>
                <h3>Accesos por mes ultimos 5 meses</h3>
                <canvas id="accesosChart" width="400" height="200"></canvas>
                <h3>Clientes por mes ultimos 5 meses</h3>
                <canvas id="clientesChart" width="400" height="200"></canvas>
            </div>

            <!-- Sección del lado derecho: Clientes Próximos a Vencer + Últimas Ventas -->
            <div class="col-right">
                <!-- Últimas Ventas -->
                <div class="card">
                    <div class="card-header">
                        <h3>Últimas Ventas</h3>
                    </div>
                    <div class="card-body">
                        @if ($ultimasVentas->isEmpty())
                            <p>No se han registrado ventas recientemente.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($ultimasVentas as $venta)
                                    <li class="list-group-item ">
                                        <div class="d-flex align-items-center">
                                            {{-- Icono con la primera letra del nombre del cliente --}}
                                            <div class="avatar-circle mr-3">
                                                <span class="initials">{{ substr($venta->cliente->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <strong>{{ $venta->cliente->name }}</strong> <br>
                                                <small>{{ $venta->paquete->nombre }} </small>
                                            </div>
                                        </div>
                                        {{-- Precio de la venta --}}
                                        <span class="badge badge-primary badge-pill">
                                            ${{ number_format($venta->paquete->precio, 0, ',', '.') }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Clientes con Membresía Próxima a Vencer -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>Clientes con Membresía Próxima a Vencer</h3>
                    </div>
                    <div class="card-body">
                        @if ($clientesProximosAVencer->isEmpty())
                            <p>No hay clientes con membresías próximas a vencer.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($clientesProximosAVencer as $asignacion)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            {{-- Icono con la primera letra del nombre del cliente --}}
                                            <div class="avatar-circle mr-3">
                                                <span class="initials">{{ substr($asignacion->cliente->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <strong>{{ $asignacion->cliente->name }}</strong> <br>
                                                <small>{{ $asignacion->paquete->nombre }} - Vence el
                                                    {{ \Carbon\Carbon::parse($asignacion->fecha_fin)->format('d/m/Y') }}</small>
                                            </div>
                                        </div>
                                        {{-- Días restantes calculados directamente --}}
                                        <span class="badge badge-warning badge-pill">
                                            {{ \Carbon\Carbon::parse($asignacion->fecha_fin)->diffInDays(now()) + 1 }} días
                                            restantes
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctxVentas = document.getElementById('ventasChart').getContext('2d');

        // Extraer datos de PHP para usar en el gráfico de ventas
        const mesesVentas = @json($resultados->pluck('mes'));
        const totalVentas = @json($resultados->pluck('total_ventas'));

        // Crear un array con los nombres de los meses
        const nombresMeses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 
            'Junio', 'Julio', 'Agosto', 'Septiembre', 
            'Octubre', 'Noviembre', 'Diciembre'
        ];

        // Inicializar arrays para los meses y ventas
        const mesesFiltradosVentas = [];
        const totalVentasFiltrados = [];

        // Obtener el mes actual
        let mesActual = new Date().getMonth() + 1; // getMonth() devuelve 0-11

        // Obtener los últimos 5 meses, comenzando desde el mes actual
        for (let i = 0; i < 5; i++) {
            const mes = (mesActual - i + 12) % 12 || 12; // Calcular el mes correcto
            mesesFiltradosVentas.unshift(nombresMeses[mes - 1]); // Nombres de los meses

            // Buscar el total de ventas para el mes actual
            const index = mesesVentas.indexOf(mes);
            totalVentasFiltrados.unshift(index !== -1 ? totalVentas[index] : 0);
        }

        const ventasChart = new Chart(ctxVentas, {
            type: 'bar', // O 'line' dependiendo de la gráfica que quieras
            data: {
                labels: mesesFiltradosVentas,
                datasets: [{
                    label: 'Total de Ventas por Mes',
                    data: totalVentasFiltrados,
                    backgroundColor: 'rgb(128, 105, 241, 0.2)',
                    borderColor: 'rgb(128, 105, 241, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 4000 // Cambia el valor máximo del eje Y a lo que necesites
                    }
                }
            }
        });

        // Configuración para la gráfica de accesos
        const ctxAccesos = document.getElementById('accesosChart').getContext('2d');

        // Extraer datos de PHP para usar en el gráfico de accesos
        const mesesAccesos = @json($resultadosAccesos->pluck('mes'));
        const totalAccesos = @json($resultadosAccesos->pluck('total_accesos'));

        // Inicializar arrays para los meses y accesos
        const mesesFiltradosAccesos = [];
        const totalAccesosFiltrados = [];

        // Obtener los últimos 5 meses, comenzando desde el mes actual
        for (let i = 0; i < 5; i++) {
            const mes = (mesActual - i + 12) % 12 || 12; // Calcular el mes correcto
            mesesFiltradosAccesos.unshift(nombresMeses[mes - 1]); // Nombres de los meses

            // Buscar el total de accesos para el mes actual
            const index = mesesAccesos.indexOf(mes);
            totalAccesosFiltrados.unshift(index !== -1 ? totalAccesos[index] : 0);
        }

        const accesosChart = new Chart(ctxAccesos, {
            type: 'bar', // O 'line' dependiendo de la gráfica que quieras
            data: {
                labels: mesesFiltradosAccesos,
                datasets: [{
                    label: 'Total de Accesos por Mes',
                    data: totalAccesosFiltrados,
                    backgroundColor: 'rgb(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 200 // Cambia el valor máximo del eje Y a lo que necesites
                    }
                }
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctxClientes = document.getElementById('clientesChart').getContext('2d');

        // Extraer datos de PHP para usar en el gráfico
        const mesesClientes = @json($clientesPorMes->pluck('mes'));
        const totalClientes = @json($clientesPorMes->pluck('total_clientes'));

        // Crear un array con los nombres de los meses
        const nombresMeses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 
            'Junio', 'Julio', 'Agosto', 'Septiembre', 
            'Octubre', 'Noviembre', 'Diciembre'
        ];

        // Inicializar arrays para los meses y total de clientes
        const mesesFiltradosClientes = [];
        const totalClientesFiltrados = [];

        // Obtener el mes actual
        let mesActual = new Date().getMonth() + 1;

        // Obtener los últimos 5 meses, comenzando desde el mes actual
        for (let i = 0; i < 5; i++) {
            const mes = (mesActual - i + 12) % 12 || 12; // Calcular el mes correcto
            mesesFiltradosClientes.unshift(nombresMeses[mes - 1]); // Nombres de los meses

            // Buscar el total de clientes para el mes actual
            const index = mesesClientes.indexOf(mes);
            totalClientesFiltrados.unshift(index !== -1 ? totalClientes[index] : 0);
        }

        // Crear la gráfica de clientes
        const clientesChart = new Chart(ctxClientes, {
            type: 'bar',
            data: {
                labels: mesesFiltradosClientes,
                datasets: [{
                    label: 'Clientes registrados',
                    data: totalClientesFiltrados,
                    backgroundColor: 'rgb(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100 // Establecer el máximo a 150 clientes
                    }
                }
            }
        });
    });
</script>
