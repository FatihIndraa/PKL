@extends('dashboard.layout.template')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Daftar Paket Foto</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPaketModal">
                <i class="bi bi-plus-lg"></i> Tambah Paket
            </button>
        </div>

        @if ($pakets->isEmpty())
            <div class="alert alert-warning text-center">Belum ada paket tersedia.</div>
        @else
            <div class="row g-4">
                @foreach ($pakets as $paket)
                    <div class="col-md-4">
                        <div class="card shadow-lg border-0 h-100">
                            <div class="position-relative">
                                <img src="{{ $paket->gambar ? asset('storage/' . $paket->gambar) : asset('img/default.jpg') }}"
                                    class="card-img-top img-thumbnail rounded-top" alt="{{ $paket->nama_paket }}"
                                    onclick="showDetail('{{ asset('storage/' . $paket->gambar) }}', 
                                                    '{{ $paket->nama_paket }}', 
                                                    '{{ $paket->deskripsi }}', 
                                                    '{{ number_format($paket->harga, 0, ',', '.') }}',
                                                    '{{ $paket->durasi }}')"
                                    style="cursor: pointer; height: 250px; object-fit: cover;">
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">{{ $paket->nama_paket }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($paket->deskripsi, 80) }}</p>
                                <p class="card-price text-primary fw-bold">Rp
                                    {{ number_format($paket->harga, 0, ',', '.') }}</p>
                                <p class="card-duration text-secondary">Durasi: {{ $paket->durasi }} menit</p>
                                <button class="btn btn-outline-primary btn-sm"
                                    onclick="showDetail('{{ asset('storage/' . $paket->gambar) }}', 
                                                    '{{ $paket->nama_paket }}', 
                                                    '{{ $paket->deskripsi }}', 
                                                    '{{ number_format($paket->harga, 0, ',', '.') }}',
                                                    '{{ $paket->durasi }}')">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </button>
                                <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $paket->id }}"
                                    data-nama="{{ $paket->nama_paket }}" data-harga="{{ $paket->harga }}"
                                    data-deskripsi="{{ $paket->deskripsi }}" data-gambar="{{ $paket->gambar }}"
                                    data-durasi="{{ $paket->durasi }}" data-bs-toggle="modal"
                                    data-bs-target="#editPaketModal">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                                <!-- Tombol Hapus -->
                                <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $paket->id }}"
                                    data-nama="{{ $paket->nama_paket }}" data-bs-toggle="modal"
                                    data-bs-target="#deletePaketModal">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Modal Tambah Paket -->
    <div class="modal fade" id="tambahPaketModal" tabindex="-1" aria-labelledby="tambahPaketModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="tambahPaketModalLabel">Tambah Paket Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                            <label for="durasi" class="form-label fw-semibold">Durasi Paket (dalam menit)</label>
                            <input type="number" class="form-control" id="durasi" name="durasi" required
                                placeholder="Masukkan durasi paket dalam menit">
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required
                                placeholder="Tuliskan deskripsi paket foto"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label fw-semibold">Upload Gambar</label>
                            <input class="form-control" id="gambar" type="file" name="gambar" required
                                accept="image/*" onchange="previewImage(event)">
                            <div class="form-text text-muted">Format yang didukung: JPG, JPEG, PNG.</div>
                        </div>

                        <div class="text-center">
                            <img id="preview" class="img-fluid rounded shadow-sm d-none" style="max-height: 200px;">
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3 py-2">
                            <i class="bi bi-save"></i> Simpan Paket
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Detail Paket --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="modalTitle">Detail Paket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="modalImage" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                    </div>
                    <h4 class="fw-bold mt-3 text-center" id="modalTitle"></h4>
                    <p class="text-muted text-center" id="modalDescription"></p>
                    <h5 class="text-center text-primary fw-bold"><span id="modalPrice"></span></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Paket -->
    <div class="modal fade" id="editPaketModal" tabindex="-1" aria-labelledby="editPaketModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editPaketModalLabel">Edit Paket Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('paket.update', $paket->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_paket" class="form-label">Nama Paket</label>
                            <input type="text" class="form-control" id="nama_paket" name="nama_paket"
                                value="{{ old('nama_paket', $paket->nama_paket) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga"
                                value="{{ old('harga', $paket->harga) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $paket->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="durasi" class="form-label">Durasi (menit)</label>
                            <input type="number" class="form-control" id="durasi" name="durasi"
                                value="{{ old('durasi', $paket->durasi) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar (Opsional)</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-warning">Update Paket</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deletePaketModal" tabindex="-1" aria-labelledby="deletePaketModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deletePaketModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus paket <strong id="deletePaketNama"></strong>?</p>
                    <form id="deletePaketForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deletePaketId" name="id">
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ketika tombol edit diklik
        document.querySelectorAll(".btn-edit").forEach(btn => {
            btn.addEventListener("click", function() {
                const paket = this.dataset;
                document.getElementById("editPaketId").value = paket.id;
                document.getElementById("edit_nama_paket").value = paket.nama;
                document.getElementById("edit_harga").value = paket.harga;
                document.getElementById("edit_deskripsi").value = paket.deskripsi;
                document.getElementById("edit_durasi").value = paket.durasi;
                if (paket.gambar) {
                    document.getElementById("editPreview").classList.remove("d-none");
                    document.getElementById("editPreview").src =
                        `{{ asset('storage/') }}/${paket.gambar}`;
                } else {
                    document.getElementById("editPreview").classList.add("d-none");
                }
            });
        });

        // Ketika tombol hapus diklik
        document.querySelectorAll(".btn-delete").forEach(btn => {
            btn.addEventListener("click", function() {
                const paket = this.dataset;
                document.getElementById("deletePaketNama").textContent = paket.nama;
                document.getElementById("deletePaketId").value = paket.id;
            });
        });
    });

    // Fungsi untuk melihat detail paket
    function showDetail(image, title, description, price, duration) {
        document.getElementById("modalImage").src = image;
        document.getElementById("modalTitle").textContent = title;
        document.getElementById("modalDescription").textContent = description;
        document.getElementById("modalPrice").textContent = price;
    }
</script>

<script>
    function showDetail(image, title, description, price, duration) {
        document.getElementById('modalImage').src = image;
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalDescription').innerText = description;
        document.getElementById('modalPrice').innerText = price;
        document.getElementById('modalDuration').innerText = `Durasi: ${duration} menit`;

        var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
        detailModal.show();
    }


    function editPaket(id) {
        $.get("{{ url('paket') }}/" + id + "/edit")
            .done(function(paket) {
                $('#editPaketId').val(paket.id);
                $('#edit_nama_paket').val(paket.nama_paket);
                $('#edit_harga').val(paket.harga);
                $('#edit_deskripsi').val(paket.deskripsi);
                if (paket.gambar) {
                    $('#editPreview').attr('src', "{{ asset('storage') }}/" + paket.gambar).removeClass('d-none');
                } else {
                    $('#editPreview').addClass('d-none');
                }
                $('#editPaketModal').modal('show');
            })
            .fail(function() {
                alert("Paket tidak ditemukan.");
            });
    }

    $('#editPaketForm').submit(function(e) {
        e.preventDefault();
        var id = $('#editPaketId').val();
        var formData = new FormData(this);

        $.ajax({
            url: "/paket/" + id,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-HTTP-Method-Override': 'PUT'
            },
            success: function(response) {
                alert("Paket berhasil diperbarui!");
                location.reload();
            },
            error: function(xhr) {
                alert("Terjadi kesalahan saat memperbarui paket.");
            }
        });

    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".btn-delete").forEach(button => {
            button.addEventListener("click", function() {
                // Ambil ID dan Nama Paket
                let id = this.getAttribute("data-id");
                let nama = this.getAttribute("data-nama");

                // Tampilkan Nama Paket di Modal
                document.getElementById("deletePaketNama").textContent = nama;

                // Atur Action Form agar mengarah ke route yang benar
                let form = document.getElementById("deletePaketForm");
                form.action = `/paket/${id}`;
            });
        });
    });
</script>
