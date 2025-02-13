<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
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

        // Pastikan kamu mengirimkan $months dan $orderData juga ke view
        return view('dashboard.index', compact('totalUsers', 'totalOrders', 'totalPackages', 'users', 'user', 'months', 'orderData'));
    }

    public function admin()
    {
        return view('dashboard.index'); // Tampilan dashboard admin
    }
}
