<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function showDokterRegistrationForm()
    {
        return view('dashboard.tambah-dokter', [
            'title' => 'Tambah Dokter',
            'active' => 'register'
        ]);
    }
    public function dataDokter()
    {
        $dokters = Dokter::all();
        return view('dashboard.data-dokter', compact('dokters'));
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Dokter::create($validatedData);

        // $request->session()->flash('success', 'Registration Successful!! Please Login');
        return redirect('/dashboard')->with('success', 'dokter berhasil ditambahkan!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokter $dokter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokter $dokter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokter $dokter)
    {
        //
    }
}
