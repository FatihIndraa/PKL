@extends('dashboard.layout.template')

@section('konten')
    <div class="col py-3">
        <div class="container-sm col-6 my-3 rounded px-5 py-3 pb-5 shadow bg-light">
            @if (session('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <h1 class="mb-4">Halo!!</h1>
            @auth('operators')
                <div class="mb-3">Selamat datang {{ Auth::guard('operators')->user()->name }}</div>
            @endauth
            @auth('dokters')
                <div class="mb-3">Selamat datang {{ Auth::guard('dokters')->user()->name }}</div>
            @endauth
            @auth('web')
                <div class="mb-3">Selamat datang {{ Auth::guard('web')->user()->name }}</div>
            @endauth
            @auth('operators')
                <a href="/dashboard/tambah-rekam-medis" class="btn btn-primary mb-2">Tambah Rekam Medis</a>
            @endauth
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Nama Dokter</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Di dalam loop foreach untuk menampilkan rekam medis -->
                        @foreach ($rekamMedis as $rekam)
                            @php
                                // Filter data rekam medis berdasarkan dokter terautentikasi
                                if (
                                    auth()->guard('dokters')->check() &&
                                    $rekam->dokter_id !== auth()->guard('dokters')->user()->id
                                ) {
                                    continue; // Lewati jika dokter tidak terkait dengan rekam medis ini
                                }

                                // Batasi keluhan menjadi maksimal 10 kata
                                $keluhan = $rekam->keluhan;
                                $wordCount = str_word_count($keluhan);

                                if ($wordCount > 10) {
                                    $keluhan = implode(' ', array_slice(str_word_count($keluhan, 1), 0, 10)) . '...';
                                }
                            @endphp

                            <tr>
                                <td>{{ $rekam->user->name }}</td>
                                <td>{{ $rekam->dokter->name }}</td>
                                <td>{{ $keluhan }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm"
                                        onclick="showPatientDetails('{{ $rekam->user->name }}', '{{ $rekam->user->gender }}', '{{ $rekam->user->alamat }}', '{{ $rekam->dokter->name }}','{{ $rekam->telp }}','{{ $rekam->keluhan }}')">
                                        <i class="bi bi-eye"></i> Lihat
                                    </button>
                                    @if (auth()->guard('web')->check())
                                        <button class="btn btn-warning btn-sm"
                                            onclick="editPatientDetails('{{ $rekam->user->name }}', '{{ $rekam->user->gender }}', '{{ $rekam->user->alamat }}', '{{ $rekam->dokter->id }}','{{ $rekam->telp }}', '{{ $rekam->keluhan }}', {{ json_encode($dokters) }}, '{{ $rekam->id }}', '{{ $rekam->user_id }}')">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                    @endif
                                    @if (auth()->guard('operators')->check() || auth()->guard('dokters')->check())
                                        <button type="button" class="btn btn-primary btn-sm"
                                            onclick="tambahTindakanModal('{{ $rekam->id }}')">
                                            <i class="bi bi-plus"></i> Tindakan
                                        </button>

                                        <button class="btn btn-danger btn-sm"
                                            onclick="deletePatient('{{ $rekam->id }}')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@include('dashboard.layout.js')
