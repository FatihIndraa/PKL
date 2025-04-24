<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Paket;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PemesananController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pakets = Paket::all();

        // Update status selesai otomatis
        $this->updateCompletedStatus();

        $pemesanans = Pemesanan::with(['paket', 'user'])
            ->when($user->role == 'member', function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->latest()
            ->get();

        return view('dashboard.pemesanan.index', compact('pemesanans', 'pakets'));
    }

    protected function updateCompletedStatus()
    {
        Pemesanan::where('status_selesai', false)
            ->where('status_pemesanan', 'disetujui')
            ->get()
            ->each(function ($pemesanan) {
                if ($pemesanan->is_completed) {
                    $pemesanan->update(['status_selesai' => true]);
                }
            });
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

        $paket = Paket::findOrFail($request->paket_id);

        $pemesanan = Pemesanan::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'email' => $request->email,
            'paket_id' => $request->paket_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'catatan' => $request->catatan,
            'status_pemesanan' => 'pending',
            // Tidak perlu menyimpan jam_selesai karena dihitung via accessor
        ]);

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

        $paket = Paket::findOrFail($request->paket_id);

        $pemesanan = Pemesanan::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'email' => $request->email,
            'paket_id' => $request->paket_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'catatan' => $request->catatan,
            'status_pemesanan' => 'pending',
        ]);

        return redirect()->route('dashboard.pemesanan.index')->with('success', 'Pemesanan berhasil dibuat');
    }

    public function pembayaran($id)
    {
        $pemesanan = Pemesanan::with('paket')->findOrFail($id);
        return view('home.pembayaran', compact('pemesanan'));
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);

        // Buat direktori jika belum ada
        if (!file_exists(public_path('uploads/bukti_pembayaran'))) {
            mkdir(public_path('uploads/bukti_pembayaran'), 0777, true);
        }

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/bukti_pembayaran'), $filename);

            $pemesanan->update([
                'bukti_pembayaran' => $filename,
                'status_pemesanan' => 'pending', // Tetap pending sampai admin approve
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
        $request->validate([
            'status_pemesanan' => 'required|in:pending,disetujui,ditolak'
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update(['status_pemesanan' => $request->status_pemesanan]);

        return redirect()->back()->with('success', 'Status pemesanan diperbarui.');
    }

    public function updateSelesai(Request $request, $id)
    {
        $request->validate([
            'status_selesai' => 'required|boolean'
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update(['status_selesai' => $request->status_selesai]);

        return redirect()->back()->with('success', 'Status selesai diperbarui.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'paket_id' => 'required|exists:pakets,id',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'catatan' => 'nullable|string',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update($request->only([
            'nama',
            'email',
            'paket_id',
            'tanggal',
            'jam',
            'catatan'
        ]));

        return redirect()->route('dashboard.pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('dashboard.pemesanan.index')->with('success', 'Pemesanan berhasil dihapus.');
    }
}
