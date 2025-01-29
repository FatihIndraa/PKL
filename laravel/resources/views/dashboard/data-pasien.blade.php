@extends('dashboard.layout.template')
@section('konten')
    {{-- isi konten --}}
    <div class="col py-3">
        <div class="bg-white container-sm col-6 border my-3 rounded px-5 py-3 pb-5">
            <h1>Data Pasien</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Email</th>
                            <!-- Hapus kolom password -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <!-- Hapus kolom password -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
