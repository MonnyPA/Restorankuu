<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
    $totalOrders = Order::count();
    $totalRevenue = Order::sum('grand_total');

    // rekapan harian
    $todayOrders = Order::whereDate('created_at', now())->count();
    $todayRevenue = Order::whereDate('created_at', now())->sum('grand_total');

    // rekapan bulanan
    $monthlyOrders = Order::whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->count();

    $monthlyRevenue = Order::whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->sum('grand_total');

    // rekepan mingguan
    $weeklyOrders = Order::whereBetween('created_at', [
        now()->startOfWeek(),
        now()->endOfWeek()
    ])->count();

    $weeklyRevenue = Order::whereBetween('created_at', [
        now()->startOfWeek(),
        now()->endOfWeek()
    ])->sum('grand_total');

    return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'todayOrders', 'todayRevenue', 'monthlyOrders', 'monthlyRevenue', 'weeklyOrders', 'weeklyRevenue'));
    }

}
