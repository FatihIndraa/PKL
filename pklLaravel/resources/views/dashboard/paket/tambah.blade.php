@extends('dashboard.layout.template')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center py-3">
                <h2 class="mb-0 fw-bold">Tambah Paket Foto</h2>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_paket" class="form-label fw-semibold">Nama Paket</label>
                        <input type="text" class="form-control" id="nama_paket" name="nama_paket" required
                            placeholder="Masukkan nama paket foto">
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label fw-semibold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="harga" name="harga" required
                                placeholder="Masukkan harga paket">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required
                            placeholder="Tuliskan deskripsi paket foto"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label fw-semibold">Upload Gambar</label>
                        <input class="form-control" id="gambar" type="file" name="gambar" required accept="image/*"
                            onchange="previewImage(event)">
                        <div class="form-text text-muted">Format yang didukung: JPG, JPEG, PNG.</div>
                    </div>

                    <div class="text-center">
                        <img id="preview" class="img-fluid rounded shadow-sm d-none" style="max-height: 250px;">
                    </div>

                    <button type="submit" class="btn btn-success w-100 mt-4 py-2">
                        <i class="bi bi-save"></i> Simpan Paket
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function previewImage(event) {
            let input = event.target;
            let preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
