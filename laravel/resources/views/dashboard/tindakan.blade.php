@extends('dashboard.layout.template')

@section('konten')
    <div class="col py-3">
        <div class="container-sm col-6 my-3 rounded px-5 py-3 pb-5 shadow bg-light">
            <h1 class="mb-4">Halo!!</h1>
            @auth('operators')
                <div class="mb-3">Selamat datang di halaman keluhan, {{ Auth::guard('operators')->user()->name }}</div>
            @endauth
            @auth('dokters')
                <div class="mb-3">Selamat datang di halaman keluhan, {{ Auth::guard('dokters')->user()->name }}</div>
            @endauth
            @auth('web')
                <div class="mb-3">Selamat datang di halaman keluhan, {{ Auth::guard('web')->user()->name }}</div>
            @endauth
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Nama Dokter</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Tindakan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tindakans as $tindakan)
                            @php
                                // Check if rekam_medis exists for this tindakan
                                if (!$tindakan->rekam_medis) {
                                    continue; // Skip this iteration if rekam_medis is null
                                }

                                // Filter data rekam medis berdasarkan dokter terautentikasi
                                if (
                                    auth()->guard('dokters')->check() &&
                                    $tindakan->rekam_medis->dokter_id !== auth()->guard('dokters')->user()->id
                                ) {
                                    continue; // Lewati jika dokter tidak terkait dengan rekam medis ini
                                }
                            @endphp

                            <tr>
                                <td>{{ $tindakan->rekam_medis->user->name }}</td>
                                <td>{{ $tindakan->rekam_medis->dokter->name }}</td>
                                <td>{{ $tindakan->rekam_medis->keluhan }}</td>
                                <td>{{ $tindakan->tindakan }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm"
                                        onclick="showTindakanDetails('{{ $tindakan->rekam_medis->user->name }}', '{{ $tindakan->rekam_medis->user->gender }}', '{{ $tindakan->rekam_medis->user->alamat }}', '{{ $tindakan->rekam_medis->dokter->name }}','{{ $tindakan->rekam_medis->telp }}','{{ $tindakan->rekam_medis->keluhan }}','{{ $tindakan->tindakan }}')">
                                        <i class="bi bi-eye"></i> Lihat
                                    </button>
                                    @if (auth()->guard('operators')->check() || auth()->guard('dokters')->check())
                                    <button class="btn btn-warning btn-sm"
                                    onclick="editTindakanModal('{{ $tindakan->id }}', '{{ $tindakan->tindakan }}')">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="deleteTindakan('{{ $tindakan->id }}')">
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

<!-- Modal untuk menampilkan detail tindakan -->
<div class="modal fade" id="tindakanDetailsModal" tabindex="-1" aria-labelledby="tindakanDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tindakanDetailsModalLabel">Detail Tindakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Nama Pasien:</h5>
                <p id="namaPasienTindakan"></p>
                <h5>Jenis Kelamin:</h5>
                <p id="jenisKelaminPasienTindakan"></p>
                <h5>Alamat:</h5>
                <p id="alamatPasienTindakan"></p>
                <h5>Nama Dokter:</h5>
                <p id="namaDokterTindakan"></p>
                <h5>Nomor yang bisa dihubungi:</h5>
                <p id="telpTindakan"></p>
                <h5>Keluhan:</h5>
                <p id="keluhanPasienTindakan"></p>
                <h5>Tindakan:</h5>
                <p id="tindakanDetail"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal untuk mengedit tindakan -->
<div class="modal fade" id="editTindakanModal" tabindex="-1" aria-labelledby="editTindakanModalLabel"
    aria-hidden="true">>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTindakanModalLabel">Edit Tindakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTindakanForm">
                    @csrf
                    <input type="hidden" id="editTindakanId" name="editTindakanId">
                    <div class="mb-3">
                        <label for="editTindakan" class="form-label">Tindakan</label>
                        <input type="text" class="form-control" id="editTindakan" name="editTindakan">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="simpanEditTindakan()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menampilkan detail tindakan
    function showTindakanDetails(nama, jenisKelamin, alamat, namaDokter, telpPasien, keluhan, tindakan) {
        document.getElementById("namaPasienTindakan").innerHTML = nama;
        document.getElementById("jenisKelaminPasienTindakan").innerHTML = jenisKelamin;
        document.getElementById("alamatPasienTindakan").innerHTML = alamat;
        document.getElementById("namaDokterTindakan").innerHTML = namaDokter;
        document.getElementById("telpTindakan").innerHTML = telpPasien;
        document.getElementById("keluhanPasienTindakan").innerHTML = keluhan;
        document.getElementById("tindakanDetail").innerHTML = tindakan;
        var myModal = new bootstrap.Modal(document.getElementById('tindakanDetailsModal'));
        myModal.show();
    }

    // Fungsi untuk menampilkan modal edit tindakan
    function editTindakanModal(tindakanId, tindakan) {
        // Isi formulir edit dengan data yang tepat
        document.getElementById("editTindakanId").value = tindakanId;
        document.getElementById("editTindakan").value = tindakan;
        // Tampilkan modal edit tindakan
        var editTindakanModal = new bootstrap.Modal(document.getElementById('editTindakanModal'));
        editTindakanModal.show();
    }

    // Fungsi untuk menyimpan perubahan pada tindakan yang diedit
    function simpanEditTindakan() {
        // Mendapatkan nilai tindakan yang diedit dari input
        var editedTindakan = document.getElementById('editTindakan').value;

        // Mendapatkan ID tindakan yang akan diubah
        var tindakanId = document.getElementById('editTindakanId').value;

        // Kirim data perubahan tindakan ke backend melalui AJAX
        $.ajax({
            type: "POST", // Ubah metode menjadi POST
            url: "/tindakan/" + tindakanId,
            data: {
                _token: "{{ csrf_token() }}",
                _method: "PUT", // Tambahkan parameter _method dengan nilai PUT
                tindakan: editedTindakan
            },
            success: function(response) {
                // Handle respons dari backend, misalnya tampilkan pesan sukses atau perbarui tampilan
                alert("Perubahan tindakan berhasil disimpan!");
                // Lakukan tindakan lain setelah penyimpanan berhasil, misalnya refresh halaman atau perbarui tampilan
                location.reload();
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan jika terjadi
                console.error(xhr.responseText);
                alert("Terjadi kesalahan saat menyimpan perubahan tindakan.");
            }
        });
    }
</script>
<script>
    function deleteTindakan(tindakanId) {
        if (confirm("Apakah Anda yakin ingin menghapus rekam medis ini?")) {
            axios.delete('/tindakan/' + tindakanId)
                .then(function(response) {
                    console.log(response);
                    alert('Tindakan berhasil dihapus');
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat menghapus rekam medis.');
                });
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- Tambahkan JavaScript Bootstrap (jQuery required) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
