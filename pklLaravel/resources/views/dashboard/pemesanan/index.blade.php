@extends('dashboard.layout.template')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Daftar Pemesanan</h2>

        <!-- Tombol Tambah Pesanan -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPemesanan">
            Tambah Pesanan
        </button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Paket</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemesanans as $pemesanan)
                    <tr>
                        <td>{{ $pemesanan->nama }}</td>
                        <td>{{ $pemesanan->email }}</td>
                        <td>{{ $pemesanan->paket->nama_paket }}</td>
                        <td>{{ $pemesanan->tanggal }}</td>
                        <td>{{ $pemesanan->jam }}</td>
                        <td>
                            <form action="{{ route('dashboard.pemesanan.updateStatus', $pemesanan->id) }}" method="POST">
                                @csrf
                                <select name="status_pemesanan" class="form-select form-select-sm"
                                    onchange="this.form.submit()">
                                    <option value="pending"
                                        {{ $pemesanan->status_pemesanan == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="disetujui"
                                        {{ $pemesanan->status_pemesanan == 'disetujui' ? 'selected' : '' }}>Disetujui
                                    </option>
                                    <option value="ditolak"
                                        {{ $pemesanan->status_pemesanan == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.pemesanan.updateSelesai', $pemesanan->id) }}" method="POST">
                                @csrf
                                <select name="status_selesai" class="form-select form-select-sm"
                                    onchange="this.form.submit()">
                                    <option value="0" {{ !$pemesanan->status_selesai ? 'selected' : '' }}>Belum
                                        Selesai</option>
                                    <option value="1" {{ $pemesanan->status_selesai ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalDetail{{ $pemesanan->id }}">Detail</button>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalEdit{{ $pemesanan->id }}">Edit</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalHapus{{ $pemesanan->id }}">Hapus</button>
                        </td>
                    </tr>


                    <!-- Modal Detail -->
                    <div class="modal fade" id="modalDetail{{ $pemesanan->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Pemesanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nama:</strong> {{ $pemesanan->nama }}</p>
                                    <p><strong>Email:</strong> {{ $pemesanan->email }}</p>
                                    <p><strong>Paket:</strong> {{ $pemesanan->paket->nama_paket }}</p>
                                    <p><strong>Tanggal:</strong> {{ $pemesanan->tanggal }}</p>
                                    <p><strong>Jam:</strong> {{ $pemesanan->jam }}</p>
                                    <p><strong>Catatan:</strong> {{ $pemesanan->catatan ?? 'Tidak ada catatan' }}</p>
                                    <h5>Bukti Pembayaran</h5>
                                    @if ($pemesanan->bukti_pembayaran)
                                        <img src="{{ asset('storage/' . $pemesanan->bukti_pembayaran) }}"
                                            class="img-fluid">
                                    @else
                                        <p class="text-danger">Belum ada bukti pembayaran</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $pemesanan->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Pemesanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('dashboard.pemesanan.update', $pemesanan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control"
                                                value="{{ $pemesanan->nama }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $pemesanan->email }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control"
                                                value="{{ $pemesanan->tanggal }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Jam</label>
                                            <input type="time" name="jam" class="form-control"
                                                value="{{ $pemesanan->jam }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="modalHapus{{ $pemesanan->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Pemesanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus pesanan ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('dashboard.pemesanan.destroy', $pemesanan->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Modal Tambah Pemesanan -->
                <div class="modal fade" id="modalTambahPemesanan" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Pemesanan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('dashboard.pemesanan.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Paket</label>
                                        <select name="paket_id" class="form-select" required>
                                            <option value="" selected disabled>Pilih Paket</option>
                                            @foreach ($pakets as $paket)
                                                <option value="{{ $paket->id }}">{{ $paket->nama_paket }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Jam</label>
                                        <input type="time" name="jam" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Catatan (Opsional)</label>
                                        <textarea name="catatan" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </tbody>
        </table>
    </div>
@endsection
