@extends('dashboard.layout.template')

@section('konten')
    <div class="table-responsive">
        <div class="container-sm col-6 my-3 rounded px-5 py-3 pb-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h1 class="mb-0">Tambah Keluhan</h1>
                </div>
                <div class="card-body">

                    <form action="/dashboard/tambah-rekam-medis" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama User</label>
                            <select class="form-select" id="name" name="user_id" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dokter" class="form-label">Dokter</label>
                            <select class="form-select" id="dokter" name="dokter" required>
                                @foreach ($dokters as $dokter)
                                    <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="telp" class="form-label">Nomor yang bisa dihubungi</label>
                            <input type="text" class="form-control" id="telp" name="telp" pattern="[0-9]+"
                                title="Hanya boleh diisi dengan angka" required>
                        </div>
                        <div class="mb-3">
                            <label for="keluhan" class="form-label">Keluhan</label>
                            <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
