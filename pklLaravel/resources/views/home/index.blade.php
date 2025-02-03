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
                background: rgba(0, 0, 0, 0.3); 
                z-index: 1;
            }
            .page-header .container {
                position: relative;
                z-index: 2;
            }
        </style>
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="page-header min-vh-75 d-flex align-items-center justify-content-center text-center"
                        style="background-image: url('{{ asset('img/foto/1.jpg') }}'); background-size: cover; background-position: center;">
                        <div class="container">
                            <h1 class="text-white pt-3 mt-n5 text-dark">Studio Delapan Kudus</h1>
                            <p class="lead text-white mt-3">Selamat datang di Studio Delapan Kudus.</p>
                            <a href="https://wa.me/6281234567890" class="btn btn-light">Pesan Sekarang</a> <!-- CTA button -->
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="page-header min-vh-75 d-flex align-items-center justify-content-center text-center"
                        style="background-image: url('{{ asset('img/foto/2.jpg') }}'); background-size: cover; background-position: center;">
                        <div class="container">
                            <h1 class="text-white pt-3 mt-n5 text-dark">Kenangan yang Abadi</h1>
                            <p class="lead text-white mt-3">Abadikan momen spesial Anda bersama kami.</p>
                            <a href="#paket" class="btn btn-light">Lihat Paket</a> <!-- CTA button -->
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="page-header min-vh-75 d-flex align-items-center justify-content-center text-center"
                        style="background-image: url('{{ asset('img/foto/3.jpg') }}'); background-size: cover; background-position: center;">
                        <div class="container">
                            <h1 class="text-white pt-3 mt-n5 text-dark">Layanan Terbaik</h1>
                            <p class="lead text-white mt-3">Kami menyediakan berbagai paket foto berkualitas tinggi.</p>
                            <a href="#paket" class="btn btn-light">Lihat Paket</a> <!-- CTA button -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol navigasi -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Animasi Wave -->
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

    <!-- Kotak Statistik -->
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
    <section id="paket" class="pt-5 pb-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4">Paket Foto Kami</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('img/foto/p1.jpg') }}" class="card-img-top" alt="Paket Foto 1">
                        <div class="card-body">
                            <h5 class="card-title">Paket Wedding</h5>
                            <p class="card-text">Abadikan momen pernikahanmu dengan kualitas foto terbaik.</p>
                            <p class="card-price">IDR 2,500,000</p>
                            <a href="#" class="btn btn-primary">Lihat Paket</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('img/foto/p1.jpg') }}" class="card-img-top" alt="Paket Foto 2">
                        <div class="card-body">
                            <h5 class="card-title">Paket Prewedding</h5>
                            <p class="card-text">Tampilkan kemesraan Anda sebelum hari besar dengan foto prewedding.</p>
                            <p class="card-price">IDR 1,800,000</p>
                            <a href="#" class="btn btn-primary">Lihat Paket</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('img/foto/p1.jpg') }}" class="card-img-top" alt="Paket Foto 3">
                        <div class="card-body">
                            <h5 class="card-title">Paket Keluarga</h5>
                            <p class="card-text">Abadikan momen kebersamaan keluarga Anda dengan harga terjangkau.</p>
                            <p class="card-price">IDR 1,200,000</p>
                            <a href="#" class="btn btn-primary">Lihat Paket</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                        <p class="lead">"Paket prewedding sangat membantu kami dalam mengabadikan kenangan manis."</p>
                        <p><strong>- Budi & Sari, Pasangan Prewedding</strong></p>
                    </div>
                    <div class="carousel-item">
                        <p class="lead">"Keluarga kami merasa sangat puas dengan hasil foto keluarga yang diambil di sini."</p>
                        <p><strong>- Joko, Keluarga</strong></p>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- Formulir Pemesanan Cepat -->
    <section id="pesan" class="pt-5 pb-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4">Pemesanan Cepat</h2>
            <form action="#" method="POST">
                <input type="text" class="form-control mb-2" placeholder="Nama Anda" required>
                <input type="email" class="form-control mb-2" placeholder="Email Anda" required>
                <select class="form-select mb-2" required>
                    <option value="">Pilih Paket</option>
                    <option value="wedding">Paket Wedding</option>
                    <option value="prewedding">Paket Prewedding</option>
                    <option value="keluarga">Paket Keluarga</option>
                </select>
                <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
            </form>
        </div>
    </section>


    <!-- Footer -->
    @include('layout.footer')

</body>
