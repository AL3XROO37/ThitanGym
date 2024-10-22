<?php

// Archivo: app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use App\Models\AgregarPaqueteCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Obtener la fecha actual
        $now = now();

        // Calcular la fecha límite para clientes con membresías próximas a vencer (ej. 7 días)
        $limiteFecha = $now->copy()->addDays(8);

        $clientesProximosAVencer = AgregarPaqueteCliente::with(['cliente', 'paquete'])
            ->where('fecha_fin', '>=', $now)
            ->where('fecha_fin', '<=', $limiteFecha) // Cambia '<' a '<='
            ->get();

        // Obtener las últimas 5 ventas (puedes cambiar este número)
        $ultimasVentas = AgregarPaqueteCliente::with(['cliente', 'paquete'])
            ->orderBy('fecha_inicio', 'desc') // Ordenar por la fecha de compra (inicio)
            ->take(5) // Limitar a 5 resultados
            ->get();

        // Obtener las ventas por mes de agregar_paquete_cliente
        $ventasPaquetes = DB::table('agregar_paquete_cliente')
            ->select(
                DB::raw('MONTH(fecha_inicio) as mes'),
                DB::raw('SUM(precio_total) as total_ventas')
            )
            ->whereYear('fecha_inicio', Carbon::now()->year) // Solo del año actual
            ->whereMonth('fecha_inicio', '>=', Carbon::now()->subMonths(5)->month) // Últimos 5 meses
            ->groupBy(DB::raw('MONTH(fecha_inicio)'));

        // Obtener las ventas por mes de visitas
        $ventasVisitas = DB::table('visitas')
            ->select(
                DB::raw('MONTH(fecha_visita) as mes'),
                DB::raw('SUM(monto_pagado) as total_ventas')
            )
            ->whereYear('fecha_visita', Carbon::now()->year) // Solo del año actual
            ->whereMonth('fecha_visita', '>=', Carbon::now()->subMonths(5)->month) // Últimos 5 meses
            ->groupBy(DB::raw('MONTH(fecha_visita)'));

        // Combinar los resultados de las dos consultas
        $ventas = $ventasPaquetes->union($ventasVisitas)->get();

        // Sumar totales combinados por mes
        $resultados = $ventas->groupBy('mes')->map(function ($items) {
            return [
                'mes' => $items->first()->mes,
                'total_ventas' => $items->sum('total_ventas'), // Sumar los totales de ambas tablas
            ];
        })->values(); // Si quieres que sea un array con índices continuos


        $accesos = DB::table('accesos')
            ->select(
                DB::raw('MONTH(fecha_acceso) as mes'),
                DB::raw('COUNT(*) as total_accesos') // Contar el número de accesos
            )
            ->whereYear('fecha_acceso', Carbon::now()->year) // Solo del año actual
            ->whereMonth('fecha_acceso', '>=', Carbon::now()->subMonths(5)->month) // Últimos 5 meses
            ->groupBy(DB::raw('MONTH(fecha_acceso)'))
            ->get();

        // Sumar totales combinados por mes (similar a las ventas)
        $resultadosAccesos = $accesos->groupBy('mes')->map(function ($items) {
            return [
                'mes' => $items->first()->mes,
                'total_accesos' => $items->sum('total_accesos'), // Sumar los totales de accesos
            ];
        })->values(); // Si quieres que sea un array con índices continuos


        $clientesPorMes = DB::table('clientes')
        ->select(
            DB::raw('MONTH(created_at) as mes'), // Agrupar por mes de registro
            DB::raw('COUNT(*) as total_clientes') // Contar el total de clientes por mes
        )
        ->whereYear('created_at', Carbon::now()->year) // Solo contar los clientes registrados en el año actual
        ->whereMonth('created_at', '>=', Carbon::now()->subMonths(5)->month) // Obtener los últimos 5 meses
        ->groupBy(DB::raw('MONTH(created_at)')) // Agrupar por mes
        ->get();

        // Pasamos ambos resultados a la vista
        return view('admin.index', compact('clientesProximosAVencer', 'ultimasVentas', 'resultados', 'resultadosAccesos', 'clientesPorMes'));
    }
}
