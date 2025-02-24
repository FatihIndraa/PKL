@extends('dashboard.layout.template')

@section('content')
    <div class="container form-container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary text-white">
                <h2 class="mb-0">Tambah Paket Foto</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_paket" class="form-label fs-5">Nama Paket</label>
                        <input type="text" class="form-control" id="nama_paket" name="nama_paket" required
                            placeholder="Masukkan nama paket foto">
                    </div>

                    <div class="mb-4">
                        <label for="harga" class="form-label fs-5">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required
                            placeholder="Masukkan harga paket">
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fs-5">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required
                            placeholder="Tuliskan deskripsi paket foto"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="gambar" class="form-label fs-5">Upload Gambar</label>
                        <input class="form-control form-control-sm" id="gambar" type="file" name="gambar" required
                            accept="image/*">
                        <div class="form-text text-muted mt-1">Pilih gambar untuk paket foto (jpg, jpeg, png)</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3 py-2">Simpan Paket</button>
                </form>
            </div>
        </div>
    </div>
@endsection
