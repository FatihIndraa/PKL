@extends('dashboard.layout.template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Pengelolaan Pengguna</h1>
                <!-- Tombol Tambah Pengguna -->
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPenggunaModal">
                    <i class="bi bi-person-plus"></i> Tambah Pengguna
                </button>

                <!-- Tabel Pengguna -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengguna as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <span class="badge {{ $item->role == 'admin' ? 'bg-danger' : 'bg-success' }}">
                                        {{ ucfirst($item->role) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $item->id }}"
                                        data-nama="{{ $item->name }}" data-email="{{ $item->email }}"
                                        data-role="{{ $item->role }}" data-bs-toggle="modal"
                                        data-bs-target="#editPenggunaModal">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $item->id }}"
                                        data-nama="{{ $item->name }}" data-bs-toggle="modal"
                                        data-bs-target="#deletePenggunaModal">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pengguna -->
    <div class="modal fade" id="addPenggunaModal" tabindex="-1" aria-labelledby="addPenggunaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addPenggunaModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addPenggunaForm" action="{{ route('pengguna.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="member">Member</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pengguna -->
    <div class="modal fade" id="editPenggunaModal" tabindex="-1" aria-labelledby="editPenggunaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editPenggunaModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPenggunaForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editPenggunaId" name="id">
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="edit_nama" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Password (kosongkan jika tidak ingin
                                mengubah)</label>
                            <input type="password" class="form-control" id="edit_password" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="edit_role" class="form-label">Role</label>
                            <select class="form-select" id="edit_role" name="role" required>
                                <option value="member">Member</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deletePenggunaModal" tabindex="-1" aria-labelledby="deletePenggunaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deletePenggunaModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pengguna <strong id="deletePenggunaNama"></strong>?</p>
                    <form id="deletePenggunaForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deletePenggunaId" name="id">
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function() {
                    let id = this.getAttribute("data-id");
                    let nama = this.getAttribute("data-nama");

                    document.getElementById("deletePenggunaNama").textContent = nama;
                    document.getElementById("deletePenggunaForm").action = `/pengguna/${id}`;
                });
            });

            document.querySelectorAll(".btn-edit").forEach(button => {
                button.addEventListener("click", function() {
                    document.getElementById("editPenggunaId").value = this.getAttribute("data-id");
                    document.getElementById("edit_nama").value = this.getAttribute("data-nama");
                    document.getElementById("edit_email").value = this.getAttribute("data-email");
                    document.getElementById("edit_role").value = this.getAttribute("data-role");
                    document.getElementById("editPenggunaForm").action =
                        `/pengguna/${this.getAttribute("data-id")}`;
                });
            });
        });
    </script>
@endsection
