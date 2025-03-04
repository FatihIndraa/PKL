<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalUsers = User::count();
        $totalPackages = Paket::count();
        $totalOrders = Pemesanan::count();
        $users = User::all();

        // Kirimkan variabel ke tampilan
        return view('dashboard.index', compact('totalUsers', 'totalOrders', 'totalPackages', 'users', 'user'));
    }


    public function admin()
    {
        return $this->index(); // Admin juga menggunakan method index()
    }

    public function paket()
    {
        return view('dashboard.paket.index');
    }
}
