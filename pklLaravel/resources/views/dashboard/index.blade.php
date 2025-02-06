<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="{{ asset('css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-200">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white" id="sidenav-main">
        <div class="sidenav-header">
            <a class="navbar-brand m-0" href="{{ url('/dashboard/index') }}">
                <img src="{{ asset('img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Studio Foto</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-dark" href="/dashboard"><i class="material-icons">dashboard</i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/paket"><i class="material-icons">photo_camera</i> Paket Foto</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/pesanan"><i class="material-icons">receipt_long</i> Pesanan</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/pengguna"><i class="material-icons">people</i> Pengguna</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/laporan"><i class="material-icons">bar_chart</i> Laporan</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/pengaturan"><i class="material-icons">settings</i> Pengaturan</a></li>
            </ul>
        </div>
    </aside>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">
            <div class="container-fluid py-1 px-3">
                <h6 class="font-weight-bolder mb-0">Dashboard</h6>
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Cari...</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid py-4">
            <div class="row min-vh-80 h-100">
                <div class="col-12">
                    <h3>Selamat datang di Admin Dashboard</h3>
                </div>
            </div>
        </div>

        <footer class="footer pt-5">
            <div class="container-fluid text-center">
                <div class="copyright text-muted">&copy; <script>document.write(new Date().getFullYear())</script>, Studio Foto</div>
            </div>
        </footer>
    </main>

    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        if (navigator.platform.indexOf('Win') > -1 && document.querySelector('#sidenav-scrollbar')) {
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), { damping: '0.5' });
        }
    </script>
</body>
</html>
