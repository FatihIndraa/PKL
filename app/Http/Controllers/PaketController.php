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
        return view('dashboard.paket.tambah');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_paket' => 'required|unique:pakets,nama_paket',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|max:2048',
            'durasi' => 'required|integer|min:1',  // Validasi untuk durasi
        ], [
            'nama_paket.unique' => 'Paket dengan nama tersebut sudah tersedia.',
            'durasi.required' => 'Durasi harus diisi.',
            'durasi.integer' => 'Durasi harus berupa angka.',
            'durasi.min' => 'Durasi minimal adalah 1.',
        ]);

        // Mengecek apakah paket dengan nama yang sama sudah ada, jika iya beri peringatan
        $existingPaket = Paket::where('nama_paket', $request->nama_paket)->first();
        if ($existingPaket) {
            return redirect()->back()->withErrors(['nama_paket' => 'Paket dengan nama ini sudah ada.'])->withInput();
        }

        // Simpan data paket baru
        $gambarPath = $request->file('gambar')->store('paket', 'public');

        Paket::create([
            'nama_paket' => $request->nama_paket,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $gambarPath,
            'durasi' => $request->durasi,  // Menyimpan durasi
        ]);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $paket = Paket::findOrFail($id);
        return response()->json($paket);
    }

    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        $request->validate([
            'nama_paket' => 'required|string|max:255|unique:pakets,nama_paket,' . $id,
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'durasi' => 'required|integer|min:1',  // Validasi durasi
        ]);

        // Update data tanpa gambar
        $paket->update([
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'durasi' => $request->durasi,  // Menyimpan durasi
        ]);

        // Jika ada gambar baru diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($paket->gambar) {
                Storage::delete('public/' . $paket->gambar);
            }

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
