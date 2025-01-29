<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\RekamMedis;
use App\Models\Tindakan;
use App\Models\User;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        
        // Ambil semua data dokter
        $dokters = Dokter::all();

        $rekam = RekamMedis::all();
        
        // Ambil semua data tindakan
        $tindakans = Tindakan::all();
        
        // Tampilkan view dan teruskan data ke view
        return view('tindakan', [
            'title' => 'Tambah Rekam Medis',
            'active' => 'rekam medis',
            'users' => $users,
            'dokters' => $dokters,
            'tindakans' => $tindakans // Teruskan data tindakan ke view
        ]);
    }
    public function viewTindakan(Request $request)
    {
        // Ambil semua data pasien
        $users = User::all();
        
        // Ambil semua data dokter
        $dokters = Dokter::all();

        $rekam = RekamMedis::all();
        
        // Ambil semua data tindakan
        $tindakans = Tindakan::all();
        
        // Tampilkan view dan teruskan data ke view
        return view('dashboard.tindakan', [
            'title' => 'Tambah Rekam Medis',
            'active' => 'rekam medis',
            'users' => $users,
            'dokters' => $dokters,
            'tindakans' => $tindakans // Teruskan data tindakan ke view
        ]);
    }
    public function store(Request $request)
    {
        // Validasi data yang diterima dari permintaan
        $request->validate([
            'rekam_medis_id' => 'required|exists:rekam_medis,id',
            'tindakan' => 'required|string|max:255',
        ]);

        // Periksa apakah rekam medis tersebut sudah memiliki tindakan
        $existingTindakan = Tindakan::where('rekam_medis_id', $request->rekam_medis_id)->first();

        // Jika sudah ada tindakan untuk rekam medis tersebut, kembalikan pesan kesalahan
        if ($existingTindakan) {
            return response()->json(['message' => 'Rekam medis ini sudah memiliki tindakan.'], 422);
        }

        // Simpan tindakan ke dalam database
        Tindakan::create([
            'rekam_medis_id' => $request->rekam_medis_id,
            'tindakan' => $request->tindakan,
        ]);

        // Berikan respons sukses
        return response()->json(['message' => 'Tindakan berhasil ditambahkan.']);
    }
    public function edit($id)
    {
        // Temukan data tindakan berdasarkan ID
        $tindakan = Tindakan::findOrFail($id);

        // Tampilkan view edit tindakan dan teruskan data tindakan
        return view('edit-tindakan', compact('tindakan'));
    }
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari permintaan
        $request->validate([
            'tindakan' => 'required|string|max:255',
        ]);

        $tindakan = Tindakan::findOrFail($id);

        $tindakan->tindakan = $request->input('tindakan');
        $tindakan->save();
        // Redirect atau kembalikan respons yang sesuai
        return redirect('/dashboard/tindakan')->with('success', 'Tindakan berhasil diperbarui.');
    }
    public function destroy($id)
    {
        try {
            // Temukan rekam medis berdasarkan ID yang diberikan
            $tindakan = Tindakan::findOrFail($id);
            
            // Hapus rekam medis
            $tindakan->delete();
            // Jika berhasil, kembalikan respons dengan pesan sukses
            return response()->json(['message' => 'Rekam Medis berhasil dihapus'], 200);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus rekam medis'], 500);
        }
    }

}