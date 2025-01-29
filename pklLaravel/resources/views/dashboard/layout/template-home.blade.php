<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Medical</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/home') }}">
                <i class="bi bi-heart-fill me-2"></i> Medical
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navcol-2">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navcol-2">
                <ul class="navbar-nav">
                    @auth('web')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <b>Selamat datang, {{ Auth::guard('web')->user()->name }}</b>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{"/dashboard"}}"><i
                                            class="bi bi-calendar-check"></i> My Dashboard</a></li>
                                <li>
                                </li>
                                <li><a class="dropdown-item" href="/tindakan"><i class="bi bi-calendar-check"></i>
                                        Tindakan</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ url('/logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-left"></i>
                                            Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                    @auth('dokters')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <b>Selamat datang, {{ Auth::guard('dokters')->user()->name }}</b>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ url('/dashboard') }}"><i
                                            class="bi bi-calendar-check"></i> My Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                <li>
                                    <form action="{{ url('/logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-left"></i>
                                            Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth

                    @auth('operators')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <b>Selamat datang, {{ Auth::guard('operators')->user()->name }}</b>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <li><a class="dropdown-item" href="{{ url('/dashboard') }}"><i
                                            class="bi bi-calendar-check"></i> My Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ url('/logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-left"></i>
                                            Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    @yield('konten')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Article Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="https://source.unsplash.com/800x600/?medical" class="img-fluid mb-3" alt="Modal Image">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquet felis vel velit pretium,
                        sit
                        amet
                        ultrices leo feugiat. Integer id nisi ac urna vestibulum rhoncus. Cras auctor nec sem vel
                        finibus. Integer
                        volutpat erat at ipsum sollicitudin, vel scelerisque odio venenatis.</p>
                    <p>Vestibulum dapibus justo vitae leo pulvinar scelerisque. Curabitur ut orci a libero tempus
                        hendrerit. Duis
                        et semper ex. In hac habitasse platea dictumst. Nam ullamcorper tellus eget justo volutpat,
                        eget
                        aliquet
                        nisi consequat.</p>
                    <p>Ut interdum, magna nec molestie elementum, ipsum metus pellentesque urna, in consectetur
                        ipsum
                        libero non
                        nisi. Donec elementum sapien a ex pharetra, sit amet aliquam purus pellentesque. Duis sit
                        amet
                        nulla
                        ligula. Duis id enim a ex vehicula consequat eget et tortor.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."
        crossorigin="anonymous"></script>
</body>

</html>
