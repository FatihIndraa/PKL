<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        return view('dashboard.paket.index', compact('pakets'));
    }

    public function create()
    {
        $pakets = Paket::all(); // Ambil semua paket
        return view('dashboard.paket.tambah', compact('pakets')); // Kembalikan ke index
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload gambar
        $gambarPath = $request->file('gambar')->store('paket', 'public');

        Paket::create([
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);
        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $paket = Paket::findOrFail($id);
        return response()->json($paket);
    }

    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        $paket->update([
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('paket', 'public');
            $paket->update(['gambar' => $gambarPath]);
        }

        return redirect()->route('paket.index')->with('success', 'Paket berhasil diupdate!');
    }

    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($paket->gambar) {
            Storage::delete('public/' . $paket->gambar);
        }

        $paket->delete();

        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus.');
    }
}
