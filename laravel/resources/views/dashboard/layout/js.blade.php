<!-- Modal untuk menampilkan detail pasien -->
<div class="modal fade" id="patientDetailsModal" tabindex="-1" aria-labelledby="patientDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="patientDetailsModalLabel">Detail Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Nama Pasien:</h5>
                <p id="namaPasien"></p>
                <h5>Jenis Kelamin:</h5>
                <p id="jenisKelaminPasien"></p>
                <h5>Alamat:</h5>
                <p id="alamatPasien"></p>
                <h5>Nama Dokter:</h5>
                <p id="namaDokter"></p>
                <h5>Nomor yang bisa dihubungi:</h5>
                <p id="telp"></p>
                <h5>Keluhan:</h5>
                <p id="keluhanPasien"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk mengedit data pasien -->
<div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPatientModalLabel">Edit Data Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPatientForm" data-rekam-medis-id="" method="PUT">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="userId">
                    <div class="mb-3">
                        <label for="editNamaPasien" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="editNamaPasien" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editNamaDokter" class="form-label">Nama Dokter</label>
                        <select class="form-select" id="editNamaDokter" name="dokter">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editJenisKelaminPasien" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="editJenisKelaminPasien" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="editAlamatPasien" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="editAlamatPasien" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="telpEdit" class="form-label">Nomor yang bisa dihubungi</label>
                        <input type="number" class="form-control" id="telpEdit">
                    </div>
                    <div class="mb-3">
                        <label for="editKeluhanPasien" class="form-label">Keluhan</label>
                        <input type="text" class="form-control" id="editKeluhanPasien">
                    </div>
                    <input type="hidden" id="userId">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahTindakanModal" tabindex="-1" aria-labelledby="tambahTindakanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahTindakanModalLabel">Tambah Tindakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tambahTindakanForm">
                    @csrf
                    <div class="mb-3">
                        <label for="tambahTindakan" class="form-label">Tindakan</label>
                        <input type="text" class="form-control" id="tambahTindakan">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                @if ($rekamMedis->isNotEmpty()) <!-- Check if $rekamMedis is not empty -->
    <button type="submit" class="btn btn-primary" onclick="tambahTindakan('{{ $rekamMedis->first()->id }}')">Simpan</button>
@else
    <button type="submit" class="btn btn-primary" disabled>Simpan</button>
@endif

            </div>

        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Fungsi untuk menampilkan detail pasien
    function showPatientDetails(nama, jenisKelamin, alamat, namaDokter, telpPasien, keluhan) {
        document.getElementById("namaPasien").innerHTML = nama;
        document.getElementById("jenisKelaminPasien").innerHTML = jenisKelamin;
        document.getElementById("alamatPasien").innerHTML = alamat;
        document.getElementById("namaDokter").innerHTML = namaDokter;
        document.getElementById("telp").innerHTML = telpPasien;
        document.getElementById("keluhanPasien").innerHTML = keluhan;
        var myModal = new bootstrap.Modal(document.getElementById('patientDetailsModal'));
        myModal.show();
    }

    // Fungsi untuk mengisi formulir edit dengan data pasien yang dipilih
    function editPatientDetails(nama, jenisKelamin, alamat, dokterId, telp, keluhan, dokters, rekamMedisId, userId) {
        // Isi formulir edit dengan data yang tepat
        document.getElementById("editNamaPasien").value = nama;
        document.getElementById("editJenisKelaminPasien").value = jenisKelamin;
        document.getElementById("editAlamatPasien").value = alamat;

        var select = document.getElementById("editNamaDokter");
        select.innerHTML = '';
        dokters.forEach(function(dokter) {
            var option = document.createElement("option");
            option.text = dokter.name;
            option.value = dokter.id;
            if (dokter.id === dokterId) {
                option.selected = true;
            }
            select.appendChild(option);
        });

        // Set nilai nomor telepon pasien menggunakan properti value
        document.getElementById("telpEdit").value = telp; // Updated ID to telpEdit

        document.getElementById("editKeluhanPasien").value = keluhan; // Isi input keluhan

        // Simpan ID pasien dan dokter dalam atribut data untuk referensi nanti
        document.getElementById("editPatientForm").setAttribute("data-pasien-id", nama);
        document.getElementById("editPatientForm").setAttribute("data-dokter-id", dokterId);
        document.getElementById("editPatientForm").setAttribute("data-rekam-medis-id", rekamMedisId);
        document.getElementById("userId").value = userId; // Atur nilai userId

        // Tampilkan modal edit
        var myModal = new bootstrap.Modal(document.getElementById('editPatientModal'));
        myModal.show();
    }


    // Menangani submit formulir edit pasien
    document.getElementById("editPatientForm").addEventListener("submit", function(event) {
        event.preventDefault();

        // Ambil data yang diedit dari formulir
        var userId = document.getElementById("userId").value;
        var rekamMedisId = this.getAttribute("data-rekam-medis-id");

        var nama = document.getElementById("editNamaPasien").value;
        var dokterId = document.getElementById("editNamaDokter").value;
        var keluhan = document.getElementById("editKeluhanPasien").value;
        var telp = document.getElementById("telpEdit").value
        var jenisKelamin = document.getElementById("editJenisKelaminPasien").value;
        var alamat = document.getElementById("editAlamatPasien").value;

        axios.put('/rekam-medis/' + rekamMedisId, {
                user_id: userId,
                dokter: dokterId,
                keluhan: keluhan,
                telp: telp,
                jenis_kelamin: jenisKelamin,
                alamat: alamat
            })
            .then(function(response) {
                console.log(response);
                alert('Rekam Medis berhasil diperbarui');
                var myModal = new bootstrap.Modal(document.getElementById('editPatientModal'));
                myModal.hide();
                window.location.reload();
            })
            .catch(function(error) {
                console.error(error);
                alert('Terjadi kesalahan saat menyimpan perubahan.');
            });
    });
</script>
<script>
    function tambahTindakanModal(rekamMedisId) {
        // Set rekamMedisId to modal data attribute
        document.getElementById('tambahTindakanForm').setAttribute('data-rekam-medis-id', rekamMedisId);

        // Show the modal
        var tambahTindakanModal = new bootstrap.Modal(document.getElementById('tambahTindakanModal'));
        tambahTindakanModal.show();
    }

    function tambahTindakan() {
        // Mendapatkan nilai tindakan dari input
        var tindakan = document.getElementById('tambahTindakan').value;

        // Mendapatkan rekamMedisId dari atribut data pada formulir
        var rekamMedisId = document.getElementById('tambahTindakanForm').getAttribute('data-rekam-medis-id');

        // Kirim permintaan AJAX untuk menyimpan tindakan
        $.ajax({
            type: "POST",
            url: "/tindakan",
            data: {
                _token: "{{ csrf_token() }}",
                rekam_medis_id: rekamMedisId,
                tindakan: tindakan
            },
            success: function(response) {
                // Tampilkan pesan sukses atau perbarui tampilan sesuai kebutuhan
                alert("Tindakan berhasil ditambahkan!");
                // Contoh: Perbarui tampilan jika diperlukan
                location.reload();
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan jika ada
                console.error(xhr.responseText);
                alert("Terjadi kesalahan. Tindakan gagal ditambahkan.");
            }
        });
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function deletePatient(rekamMedisId) {
        if (confirm("Apakah Anda yakin ingin menghapus rekam medis ini?")) {
            axios.delete('/rekam-medis/' + rekamMedisId)
                .then(function(response) {
                    console.log(response);
                    alert('Rekam Medis berhasil dihapus');
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat menghapus rekam medis.');
                });
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
