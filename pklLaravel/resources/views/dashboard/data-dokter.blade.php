@extends('dashboard.layout.template')
@section('konten')
    {{-- isi konten --}}
    <div class="col py-3">
        <div class="bg-white container-sm col-6 border my-3 rounded px-5 py-3 pb-5">
            <h1>Data Dokter</h1>
            @auth('operators')
                <a href="/dashboard/tambah-dokter" class="btn btn-primary mb-2">Tambah Dokter</a>
            @endauth
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Dokter</th>
                            <th scope="col">Email</th>
                            <!-- Hapus kolom password -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokters as $dokter)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dokter->name }}</td>
                                <td>{{ $dokter->email }}</td>
                                <!-- Hapus kolom password -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
