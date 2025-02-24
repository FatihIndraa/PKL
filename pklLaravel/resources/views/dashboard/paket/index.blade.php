@extends('dashboard.layout.template')

@section('content')
    <div class="container">
        <h2>Daftar Paket Foto</h2>
        <a href="{{ route('paket.create') }}" class="btn btn-success mb-3">Tambah Paket</a>
        <div class="row">
            @foreach ($pakets as $paket)
                <div class="col-md-4">
                    <div class="card">
                        {{-- Cek apakah gambar tersedia --}}
                        @if ($paket->gambar)
                            <img src="{{ asset('storage/' . $paket->gambar) }}" class="card-img-top img-thumbnail"
                                alt="{{ $paket->nama_paket }}" onclick="showDetail('{{ asset('storage/' . $paket->gambar) }}', '{{ $paket->nama_paket }}', '{{ $paket->deskripsi }}', '{{ number_format($paket->harga, 0, ',', '.') }}')"
                                style="cursor: pointer;">
                        @else
                            <img src="{{ asset('img/default.jpg') }}" class="card-img-top img-thumbnail"
                                alt="Default Image" onclick="showDetail('{{ asset('img/default.jpg') }}', 'Paket Tidak Tersedia', 'Deskripsi tidak tersedia', '0')"
                                style="cursor: pointer;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $paket->nama_paket }}</h5>
                            <p class="card-text">{{ $paket->deskripsi }}</p>
                            <p class="card-text"><strong>Rp {{ number_format($paket->harga, 0, ',', '.') }}</strong></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Modal untuk Detail Paket --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Paket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" class="img-fluid mb-3" style="max-height: 400px;">
                    <h4 id="modalTitle"></h4>
                    <p id="modalDescription"></p>
                    <p><strong>Harga: Rp <span id="modalPrice"></span></strong></p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    function showDetail(image, title, description, price) {
        document.getElementById('modalImage').src = image;
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalDescription').innerText = description;
        document.getElementById('modalPrice').innerText = price;

        var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
        detailModal.show();
    }
</script>
@endsection
