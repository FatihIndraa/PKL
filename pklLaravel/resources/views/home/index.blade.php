@extends('layout.head')

<body class="index-page">

    <!-- Navbar -->
  @include('layout.navbar')
  
    <!-- hero section -->
    <header class="header-2">
        <div class="page-header min-vh-75 relative"
            style="background-image: url('https://images.unsplash.com/photo-1445452916036-9022dfd33aa8?q=80&w=2973&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 text-center mx-auto">
                        <h1 class="text-white pt-3 mt-n5 text-dark">Studio Delapan Kudus</h1>
                        <p class="lead text-white mt-3">Selamat datang di Studio Delapan Kudus. </p>
                    </div>
                </div>
            </div>

            <div class="position-absolute w-100 z-index-1 bottom-0">
                <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                        <path id="gentle-wave"
                            d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                    </defs>
                    <g class="moving-waves">
                        <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40" />
                        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
                        <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
                        <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
                        <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
                        <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95" />
                    </g>
                </svg>
            </div>
        </div>
    </header>

    <!-- kotak an bawah awalan -->
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
    

    <!-- footer -->
  @include('layout.footer')