<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <nav
                class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid px-0">
                    <a class="navbar-brand font-weight-bolder ms-sm-3" href="/" rel="tooltip"
                        title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
                        Studio Delapan Kudus
                    </a>
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>

                    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                        <ul class="navbar-nav navbar-nav-hover ms-lg-12 ps-lg-5 w-100">
                            <li class="nav-item mx-2">
                                <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                                    href="#paket" aria-expanded="false">
                                    Paket Foto
                                </a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                                    href="#pesan" aria-expanded="false">
                                    Pesan
                                </a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                                    href="#lokasi" aria-expanded="false">
                                    Lokasi
                                </a>
                            </li>
                            @auth
                                <li class="nav-item mx-2">
                                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                                        href="{{ Auth::user()->role == 'admin' ? route('dashboard.admin') : route('dashboard.member') }}"
                                        aria-expanded="false">
                                        Dashboard
                                    </a>
                                </li>
                            @endauth

                            <!-- Check if the user is logged in -->
                            @auth
                                <!-- If the user is logged in (admin or member), show 'Logout' -->
                                <li class="nav-item my-auto ms-auto">
                                    <a href="{{ route('logout') }}"
                                        class="btn btn-sm btn-outline-dark btn-round mb-0 me-1 mt-2 mt-md-0"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <!-- Hidden logout form -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <!-- If the user is not logged in, show 'Login' -->
                                <li class="nav-item my-auto ms-auto">
                                    <a href="{{ url('login') }}"
                                        class="btn btn-sm btn-outline-dark btn-round mb-0 me-1 mt-2 mt-md-0">Sign in</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>
