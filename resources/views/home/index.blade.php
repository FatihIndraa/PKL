@extends('layout.head')

<body class="index-page">
    <!-- Navbar -->
    @include('layout.navbar')

    <!-- Hero Section -->
    <header class="header-2 position-relative overflow-hidden">
        <style>
            .page-header::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.4);
                z-index: 1;
                transition: background 0.3s ease-in-out;
            }

            .page-header .container {
                position: relative;
                z-index: 2;
                animation: fadeInUp 1s ease-in-out;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="page-header min-vh-75 d-flex align-items-center justify-content-center text-center"
                        style="background-image: url('{{ asset('img/foto/1.jpg') }}'); background-size: cover; background-position: center;">
                        <div class="container">
                            <h1 class="text-white pt-3 mt-n5 text-light fw-bold">Studio Delapan Kudus</h1>
                            <p class="lead text-white mt-3">Tempat terbaik untuk mengabadikan momen berharga Anda.</p>
                            <a href="https://wa.me/62895381191380" class="btn btn-primary shadow-lg">Pesan
                                Sekarang</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="page-header min-vh-75 d-flex align-items-center justify-content-center text-center"
                        style="background-image: url('{{ asset('img/foto/2.jpg') }}'); background-size: cover; background-position: center;">
                        <div class="container">
                            <h1 class="text-white pt-3 mt-n5 text-light fw-bold">Kenangan Abadi</h1>
                            <p class="lead text-white mt-3">Abadikan momen spesial dengan hasil terbaik.</p>
                            <a href="#paket" class="btn btn-warning shadow-lg">Lihat Paket</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="page-header min-vh-75 d-flex align-items-center justify-content-center text-center"
                        style="background-image: url('{{ asset('img/foto/3.jpg') }}'); background-size: cover; background-position: center;">
                        <div class="container">
                            <h1 class="text-white pt-3 mt-n5 text-light fw-bold">Layanan Terbaik</h1>
                            <p class="lead text-white mt-3">Paket foto berkualitas untuk setiap momen istimewa.</p>
                            <a href="#paket" class="btn btn-success shadow-lg">Lihat Paket</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigasi Carousel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="wave-container position-absolute w-100 bottom-0 start-0 z-index-2">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave"
                        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="moving-waves">
                    <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
                    <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
                    <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
                    <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95)" />
                </g>
            </svg>
        </div>
    </header>

    <section class="pt-3 pb-4" id="count-stats">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 z-index-2 border-radius-xl mt-n10 mx-auto py-3 blur shadow-blur">
                    <div class="row justify-content-center">
                        <div class="col-md-4 position-relative mx-auto">
                            <div class="p-3 text-center">
                                <h1 class="text-gradient text-dark">
                                    <span id="state1" countTo="100">0</span>+
                                </h1>
                                <h5 class="mt-3">Terpercaya</h5>
                                <p class="text-sm">Lebih dari 100+ pelanggan yang puas dengan layanan kami.</p>
                            </div>
                            <hr class="vertical dark">
                        </div>

                        <div class="col-md-4 position-relative mx-auto">
                            <div class="p-3 text-center">
                                <h1 class="text-gradient text-dark">
                                    <span id="state2" countTo="15">0</span>+
                                </h1>
                                <h5 class="mt-3">Banyak pilihan Paket</h5>
                                <p class="text-sm">Kami menyediakan berbagai macam paket foto untuk kalian.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Paket Foto -->
    <section id="paket" class="py-5">
        <div class="container text-center">
            <h2 class="mb-4 fw-bold">Paket Foto Kami</h2>

            <div class="row g-4">
                @foreach ($pakets as $paket)
                    <div class="col-md-4">
                        <div class="card shadow-lg border-0 h-100">
                            <img src="{{ asset('storage/' . $paket->gambar) }}"
                                class="card-img-top img-thumbnail rounded-top" alt="{{ $paket->nama_paket }}"
                                onclick="showDetail('{{ asset('storage/' . $paket->gambar) }}', 
                                                '{{ $paket->nama_paket }}', 
                                                '{{ $paket->deskripsi }}', 
                                                '{{ number_format($paket->harga, 0, ',', '.') }}')"
                                style="cursor: pointer; object-fit: cover; height: 250px;">

                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">{{ $paket->nama_paket }}</h5>
                                <p class="card-text">{{ Str::limit($paket->deskripsi, 80) }}</p>
                                <p class="card-price fw-bold text-primary">
                                    IDR {{ number_format($paket->harga, 0, ',', '.') }}
                                </p>
                                <button class="btn btn-primary"
                                    onclick="showDetail('{{ asset('storage/' . $paket->gambar) }}', 
                                                        '{{ $paket->nama_paket }}', 
                                                        '{{ $paket->deskripsi }}', 
                                                        '{{ number_format($paket->harga, 0, ',', '.') }}')">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Modal Detail Paket -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="detailModalLabel">Detail Paket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="detailGambar" src="" class="img-fluid mb-3 rounded shadow-sm"
                        alt="Gambar Paket" style="max-height: 400px;">
                    <h4 id="detailNama" class="fw-bold"></h4>
                    <p id="detailDeskripsi"></p>
                    <p class="fw-bold text-primary">IDR <span id="detailHarga"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimoni Pelanggan -->
    <section id="testimoni" class="pt-5 pb-5">
        <div class="container text-center">
            <h2 class="mb-4">Apa Kata Mereka?</h2>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <p class="lead">"Layanan sangat memuaskan! Hasil foto sangat bagus dan profesional."</p>
                        <p><strong>- Andi, Pengantin</strong></p>
                    </div>
                    <div class="carousel-item">
                        <p class="lead">"Paket prewedding sangat membantu kami dalam mengabadikan kenangan manis."
                        </p>
                        <p><strong>- Budi & Sari, Pasangan Prewedding</strong></p>
                    </div>
                    <div class="carousel-item">
                        <p class="lead">"Keluarga kami merasa sangat puas dengan hasil foto keluarga yang diambil di
                            sini."</p>
                        <p><strong>- Joko, Keluarga</strong></p>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>
    
    <!-- Formulir Pemesanan -->
    @if (Auth::check())
        
    <section id="pesan" class="pt-5 pb-5">
        <div class="container">
            <h2 class="mb-3 fw-bold text-center">Booking Sesi Foto Anda Sekarang</h2>
            <p class="mb-4 text-muted text-center">
                Wujudkan momen spesial dengan sesi foto berkualitas.
                Pilih paket yang sesuai, tentukan jadwal, dan kami siap mengabadikan momen terbaik Anda!
            </p>

            <form action="{{ route('pemesanan.store') }}" method="POST" class="row g-3">
                @csrf

                <!-- Nama -->
                <div class="col-md-6">
                    <label class="form-label, disable">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda"
                        required>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" disabled>
                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                </div>


                <!-- Pilihan Paket -->
                <div class="col-md-6">
                    <label class="form-label">Pilih Paket Foto</label>
                    <select name="paket_id" class="form-select" required>
                        <option value="">Pilih Paket</option>
                        @foreach ($pakets as $paket)
                            <option value="{{ $paket->id }}">{{ $paket->nama_paket }} - IDR
                                {{ number_format($paket->harga, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Tanggal -->
                <div class="col-md-6">
                    <label class="form-label">Tanggal Sesi Foto</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <!-- Pilih Jam -->
                <div class="col-md-6">
                    <label class="form-label">Jam Sesi Foto</label>
                    <input type="time" name="jam" class="form-control" required>
                </div>

                <!-- Catatan Tambahan -->
                <div class="col-md-6">
                    <label class="form-label">Catatan Tambahan</label>
                    <textarea name="catatan" class="form-control" rows="2" placeholder="Tambahkan catatan (opsional)"></textarea>
                </div>

                <!-- Tombol Submit -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
                </div>
            </form>
        </div>
    </section>
    @endif

    <!-- Section Lokasi -->
    <section id="lokasi" class="pt-5 pb-5 bg-white">
        <div class="container text-center">
            <h2 class="mb-4">Lokasi Studio</h2>
            <p class="mb-4">Temukan kami dengan mudah di lokasi berikut:</p>

            <!-- Google Maps Embed -->
            <div class="map-container"
                style="position: relative; overflow: hidden; padding-bottom: 56.25%; height: 0;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.027587835461!2d110.8601268!3d-6.766490499999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70db48c0e732d5%3A0x5b474dcac6e67e00!2sStudio%20Delapan%20kudus!5e0!3m2!1sen!2sid!4v1738625756662!5m2!1sen!2sid"
                    width="100%" height="700" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <!-- Info Alamat -->
            <div class="mt-4">
                <h5 class="fw-bold">Studio Delapan Kudus</h5>
                <p>Jl. Dwarawati VIII Perumahan Gerbang Harapan No.8, Gondang Harapan, Gondangmanis, Kec. Bae, Kabupaten
                    Kudus, Jawa Tengah 59327</p>
                <a href="https://maps.app.goo.gl/tuKGzEuUcnLaTrEr6" target="_blank" class="btn btn-primary">
                    <i class="fas fa-map-marker-alt"></i> Lihat di Google Maps
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('layout.footer')
</body>
