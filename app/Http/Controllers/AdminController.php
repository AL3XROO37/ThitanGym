<?php

// Archivo: app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use App\Models\AgregarPaqueteCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Obtener la fecha actual
        $now = now();

        // Calcular la fecha límite para clientes con membresías próximas a vencer (ej. 7 días)
        $limiteFecha = $now->copy()->addDays(10);

        $clientesProximosAVencer = AgregarPaqueteCliente::with(['cliente', 'paquete'])
        ->where('fecha_fin', '>=', $now)
        ->where('fecha_fin', '<=', $limiteFecha) // Cambia '<' a '<='
        ->get();

        // Obtener las últimas 5 ventas (puedes cambiar este número)
        $ultimasVentas = AgregarPaqueteCliente::with(['cliente', 'paquete'])
            ->orderBy('fecha_inicio', 'desc') // Ordenar por la fecha de compra (inicio)
            ->take(5) // Limitar a 5 resultados
            ->get();

        // Agrupar las ventas por mes y calcular el total de ventas
        $ventas = DB::table('agregar_paquete_cliente')
        ->select(
            DB::raw('MONTH(fecha_inicio) as mes'),
            DB::raw('SUM(precio_total) as total_ventas')
        )
        ->whereYear('fecha_inicio', Carbon::now()->year) // Solo del año actual
        ->whereMonth('fecha_inicio', '>=', Carbon::now()->subMonths(5)->month) // Últimos 5 meses
        ->groupBy(DB::raw('MONTH(fecha_inicio)'))
        ->orderBy(DB::raw('MONTH(fecha_inicio)')) // Ordenar por mes
        ->get();


        // Pasamos ambos resultados a la vista
        return view('admin.index', compact('clientesProximosAVencer', 'ultimasVentas', 'ventas'));
    }
}
