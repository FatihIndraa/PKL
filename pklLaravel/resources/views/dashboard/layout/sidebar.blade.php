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
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                    href="/">
                    <i class="material-symbols-rounded me-2">home</i>
                    <span class="nav-link-text">Halaman Utama</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                    href="{{ Auth::user()->role == 'admin' ? route('dashboard.admin') : route('dashboard.member') }}">
                    <i class="material-symbols-rounded me-2">dashboard</i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/users') ? 'active bg-dark text-white' : 'text-dark' }}"
                        href="{{ route('pengguna.index') }}">
                        <i class="material-symbols-rounded me-2">people</i>
                        <span class="nav-link-text">Pengguna</span>
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/packages') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="{{ route('paket.index') }}">
                        <i class="material-symbols-rounded me-2">photo_camera</i>
                        <span class="nav-link-text">Paket Studio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/orders') ? 'active bg-gradient-dark text-white' : 'text-dark' }}"
                        href="/admin/orders">
                        <i class="material-symbols-rounded me-2">shopping_cart</i>
                        <span class="nav-link-text">Pemesanan</span>
                    </a>
                </li>
            @elseif(auth()->user()->role == 'member')
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
