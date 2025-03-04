<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Paket;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with('paket')->get();
        $pakets = Paket::all(); // Ambil semua paket

        return view('dashboard.pemesanan.index', compact('pemesanans', 'pakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'paket_id' => 'required|exists:pakets,id',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'catatan' => 'nullable|string',
        ]);

        // Simpan ke database
        $pemesanan = Pemesanan::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'email' => $request->email,
            'paket_id' => $request->paket_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'catatan' => $request->catatan,
            'status_pemesanan' => 'pending', // Status awal 'pending'
        ]);

        // Redirect ke halaman pembayaran setelah pemesanan sukses
        return redirect()->route('pembayaran.show', $pemesanan->id);
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'paket_id' => 'required|exists:pakets,id',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'catatan' => 'nullable|string',
        ]);

        // Simpan ke database
        $pemesanan = Pemesanan::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'email' => $request->email,
            'paket_id' => $request->paket_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'catatan' => $request->catatan,
            'status_pemesanan' => 'pending', // Status awal 'pending'
        ]);

        return redirect()->route('dashboard.pemesanan.index', $pemesanan->id);
    }



    public function pembayaran($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return view('home.pembayaran', compact('pemesanan'));
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/bukti_pembayaran'), $filename);

            $pemesanan->update([
                'bukti_pembayaran' => $filename,
                'status_pemesanan' => 'pending',
            ]);
        }

        return redirect()->route('home')->with('success', 'Bukti pembayaran berhasil diunggah!');
    }

    public function approve($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update(['status_pemesanan' => 'disetujui']);

        return redirect()->route('dashboard.pemesanan.index')->with('success', 'Pemesanan telah disetujui.');
    }

    public function updateStatus(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update(['status_pemesanan' => $request->status_pemesanan]);

        return redirect()->route('dashboard.pemesanan.index')->with('success', 'Status pemesanan diperbarui.');
    }

    public function updateSelesai(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update(['status_selesai' => $request->status_selesai]);

        return redirect()->route('dashboard.pemesanan.index')->with('success', 'Status selesai diperbarui.');
    }

    public function update(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update($request->all());

        return redirect()->route('dashboard.pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pemesanan::findOrFail($id)->delete();

        return redirect()->route('dashboard.pemesanan.index')->with('success', 'Pemesanan berhasil dihapus.');
    }
}
