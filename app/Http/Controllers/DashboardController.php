<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;
use Carbon\Carbon;
use App\Models\Ratting;

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

    public function ratting()
    {
        $rattings = Ratting::with('user')->latest()->get();

        // Statistik
        $totalRatting = $rattings->count();
        $averageRatting = round($rattings->avg('rating'), 1);

        // Jumlah masing-masing bintang
        $rattingCounts = [
            5 => $rattings->where('rating', 5)->count(),
            4 => $rattings->where('rating', 4)->count(),
            3 => $rattings->where('rating', 3)->count(),
            2 => $rattings->where('rating', 2)->count(),
            1 => $rattings->where('rating', 1)->count(),
        ];

        return view('dashboard.ratting.index', compact('rattings', 'totalRatting', 'averageRatting', 'rattingCounts'));
    }
}
