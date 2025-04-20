<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Ratting;

class HomeController extends Controller
{
    public function index()
    {
        $pakets = Paket::all(); // Ambil semua paket
        $rattings = Ratting::latest()->get(); // Ambil semua ratting

        return view('home.index', compact('pakets', 'rattings'));
    }
}
