<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ratting; // Pastikan menggunakan model yang benar
use Illuminate\Support\Facades\Auth;

class RattingController extends Controller
{
    public function index()
    {
        $rattings = Ratting::latest()->get();
        return view('home.ratting', compact('rattings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:255',
        ]);

        Ratting::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->back()->with('success', 'Terima kasih atas penilaian Anda!');
    }
}
