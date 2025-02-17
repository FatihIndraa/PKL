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
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/material-dashboard.min.css?v=3.2.0') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
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
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="{{ Auth::user()->role == 'admin' ? route('dashboard.admin') : route('dashboard.member') }}">
                        <i class="material-symbols-rounded me-2">dashboard</i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>

                <!-- Halaman Utama Menu -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="/">
                        <i class="material-symbols-rounded me-2">home</i>
                        <span class="nav-link-text">Halaman Utama</span>
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
                            href="/admin/packages">
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

    <!-- Main Content -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3">
                            <p class="text-sm mb-0">Total Pengguna</p>
                            <h4 class="mb-0">{{ $totalUsers }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3">
                            <p class="text-sm mb-0">Total Paket</p>
                            <h4 class="mb-0">{{ $totalPackages }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3">
                            <p class="text-sm mb-0">Total Pemesanan</p>
                            <h4 class="mb-0">{{ $totalOrders }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Grafik Pemesanan</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Daftar Pengguna</h6>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Core JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('ordersChart').getContext('2d');
        var ordersChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Pemesanan',
                    data: @json($orderData),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            }
        });
    </script>
</body>

</html>
