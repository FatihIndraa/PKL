<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" sizes="32x32" type="image/png" href="{{ asset('/img/delapan.png') }}">
    <title>
        {{ auth()->user()->role }}
        @if (Route::currentRouteName())
            - {{ ucfirst(str_replace('-', ' ', Route::currentRouteName())) }}
        @else
            - Dashboard
        @endif
        - Studio Foto
    </title>

    <!-- Icons & Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded">
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet">

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/material-dashboard.min.css?v=3.2.0') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <style>
        .form-container {
            margin-top: 30px;
        }

        .form-container .card {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container .card-header {
            background-color: #f8f9fa;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .form-container .form-control {
            border-radius: 10px;
        }

        .form-container .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 12px 30px;
            border-radius: 10px;
        }

        .form-container .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .custom-file-input {
            border-radius: 10px;
            padding: 10px;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">

    <!-- Sidebar -->
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start bg-white my-2 ps-3"
        id="sidenav-main">
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand px-4 py-3 m-0 d-flex align-items-center" href="#">
                <i class="fa-solid fa-camera text-dark me-2"></i>
                <span class="text-sm text-dark fw-bold">Studio Delapan</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0 mb-2">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">

                <!-- Halaman Utama Menu -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="/">
                        <i class="material-symbols-rounded me-2">home</i>
                        <span class="nav-link-text">Halaman Utama</span>
                    </a>
                </li>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="{{ Auth::user()->role == 'admin' ? route('dashboard.admin') : route('dashboard.member') }}">
                        <i class="material-symbols-rounded me-2">dashboard</i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>

                @if (auth()->user()->role == 'admin')
                    <!-- Pengguna -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/users') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                            href="/admin/users">
                            <i class="material-symbols-rounded me-2">people</i>
                            <span class="nav-link-text">Pengguna</span>
                        </a>
                    </li>

                    <!-- Paket Studio -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/packages') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                            href="{{ route('paket.create') }}">
                            <i class="material-symbols-rounded me-2">photo_camera</i>
                            <span class="nav-link-text">Paket Studio</span>
                        </a>
                    </li>

                    <!-- Pemesanan -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/orders') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                            href="/admin/orders">
                            <i class="material-symbols-rounded me-2">shopping_cart</i>
                            <span class="nav-link-text">Pemesanan</span>
                        </a>
                    </li>
                @elseif(auth()->user()->role == 'member')
                    <!-- Pemesanan untuk Member -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('member/orders') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                            href="/member/orders">
                            <i class="material-symbols-rounded me-2">shopping_cart</i>
                            <span class="nav-link-text">Pemesanan</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </aside>
    <!-- End Sidebar -->

    {{-- <div class="container">
            <h2>Daftar Paket Foto</h2>
            <a href="{{ route('paket.create') }}" class="btn btn-success mb-3">Tambah Paket</a>
            <div class="row">
                @foreach ($pakets as $paket)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $paket->gambar) }}" class="card-img-top"
                                alt="{{ $paket->nama_paket }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $paket->nama_paket }}</h5>
                                <p class="card-text">{{ $paket->deskripsi }}</p>
                                <p class="card-text"><strong>Rp {{ number_format($paket->harga, 0, ',', '.') }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}


    <div class="container form-container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary text-white">
                <h2 class="mb-0">Tambah Paket Foto</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="nama_paket" class="form-label fs-5">Nama Paket</label>
                        <input type="text" class="form-control" id="nama_paket" name="nama_paket" required
                            placeholder="Masukkan nama paket foto">
                    </div>

                    <div class="mb-4">
                        <label for="harga" class="form-label fs-5">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required
                            placeholder="Masukkan harga paket">
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fs-5">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required
                            placeholder="Tuliskan deskripsi paket foto"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="gambar" class="form-label fs-5">Upload Gambar</label>
                        <input class="form-control form-control-sm" id="gambar" type="file" name="gambar"
                            required accept="image/*">
                        <div class="form-text text-muted mt-1">Pilih gambar untuk paket foto (jpg, jpeg, png)</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3 py-2">Simpan Paket</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
</body>

</html>
