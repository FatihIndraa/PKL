<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data pengguna
        $users = User::all();
        // Ambil semua data dokter
        $dokters = Dokter::all();
        // Tampilkan view dan teruskan data ke view
        return view('dashboard.tambah-rekam-medis', [
            'title' => 'Tambah Rekam Medis',
            'active' => 'rekam medis',
            'users' => $users,
            'dokters' => $dokters 
        ]);
    }

    public function showRekamMedis()
    {
        // Ambil semua data rekam medis
        $rekamMedis = RekamMedis::all();
        // Ambil semua data dokter
        $dokters = Dokter::all();
        if (Auth::guard('operators')->check() || Auth::guard('dokters')->check()) {
            $rekamMedis = RekamMedis::all();
        } else {
            // Ambil ID pengguna yang saat ini masuk
            $userId = Auth::id();
            // Ambil semua data rekam medis yang terkait dengan pengguna yang saat ini masuk
            $rekamMedis = RekamMedis::where('user_id', $userId)->get();
        }
        // Tampilkan view dan teruskan data ke view
        return view('dashboard.index', [
            'title' => 'Data Rekam Medis',
            'active' => 'rekam medis',
            'rekamMedis' => $rekamMedis,
            'dokters' => $dokters, 
        ]);
    }
    
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'user_id' => 'required',
            'dokter' => 'required',
            'telp' => 'required',
            'keluhan' => 'required',
        ]);
    
        // Buat rekam medis baru berdasarkan data yang diterima
        $rekamMedis = new RekamMedis();
        
        // Set user_id sesuai dengan kondisi
        if (Auth::guard('web')->check()) {
            $rekamMedis->user_id = Auth::id(); 
        } else {
            $rekamMedis->user_id = $validatedData['user_id'];
        }
    
        // Set dokter_id, telp, dan keluhan
        $rekamMedis->dokter_id = $validatedData['dokter'];
        $rekamMedis->telp = $validatedData['telp'];
        $rekamMedis->keluhan = $validatedData['keluhan'];
        
        // Simpan rekam medis
        $rekamMedis->save();
        
        // Redirect ke halaman tertentu setelah berhasil menyimpan rekam medis
        if (Auth::guard('web')->check()) {
            return redirect('/home')->with('success', 'Rekam Medis berhasil ditambahkan');
        } else {
            return redirect('/dashboard')->with('success', 'Rekam Medis berhasil ditambahkan');
        }
    }
        public function edit($id)
    {
        // Temukan rekam medis berdasarkan ID yang diberikan
        $rekamMedis = RekamMedis::findOrFail($id);
        // Ambil semua data dokter
        $dokters = Dokter::all();
        // Tampilkan view dan teruskan data ke view
        return view('dashboard.edit-rekam-medis', [
            'title' => 'Edit Rekam Medis',
            'active' => 'rekam medis',
            'rekamMedis' => $rekamMedis, 
            'dokters' => $dokters 
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'dokter' => 'required',
            'telp' => 'required',
            'keluhan' => 'required',
        ]);
        // Temukan rekam medis berdasarkan ID yang diberikan
        $rekamMedis = RekamMedis::findOrFail($id);
        // Update data rekam medis dengan data yang diterima dari request
        $rekamMedis->user_id = auth()->user()->id;
        $rekamMedis->dokter_id = $validatedData['dokter']; 
        $rekamMedis->telp = $validatedData['telp'];
        $rekamMedis->keluhan = $validatedData['keluhan'];
        $rekamMedis->save();

        // Redirect ke halaman tertentu setelah berhasil menyimpan perubahan rekam medis
        return response()->json(['message' => 'Rekam Medis berhasil diperbarui'], 200);
    }

    public function destroy($id)
    {
        try {
            // Temukan rekam medis berdasarkan ID yang diberikan
            $rekamMedis = RekamMedis::findOrFail($id);
            
            // Hapus rekam medis
            $rekamMedis->delete();
            // Jika berhasil, kembalikan respons dengan pesan sukses
            return response()->json(['message' => 'Rekam Medis berhasil dihapus'], 200);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus rekam medis'], 500);
        }
    }

}
