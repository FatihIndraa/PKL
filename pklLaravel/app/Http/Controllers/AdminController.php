<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paket;
use App\Models\transaksi;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan semua method dalam controller memerlukan login
    }

    public function dashboard()
{
    $totalUsers = User::count();
    $totalPackages = Paket::count();
    $totalOrders = Transaksi::count();
    $users = User::all();

    // Ambil data transaksi per bulan untuk grafik
    $months = [];
    $orderData = [];

    for ($i = 0; $i < 6; $i++) { // 6 bulan terakhir
        $month = Carbon::now()->subMonths($i)->format('F Y'); // Nama bulan + tahun
        $count = Transaksi::whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                          ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                          ->count();
        array_unshift($months, $month);
        array_unshift($orderData, $count);
    }

    return view('dashboard.index', compact('totalUsers', 'totalPackages', 'totalOrders', 'users', 'months', 'orderData'));
}
}
