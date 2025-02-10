<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\paket;
use App\Models\transaksi;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalPackages = paket::count();
        $totalOrders = transaksi::count();

        $months = paket::selectRaw('MONTH(created_at) as month')
            ->groupBy('month')
            ->pluck('month')
            ->toArray();

        $orderData = paket::selectRaw('COUNT(id) as count')
            ->groupBy('month')
            ->pluck('count')
            ->toArray();

        return view('admin.dashboard', compact('totalUsers', 'totalPackages', 'totalOrders', 'months', 'orderData'));
    }

}
