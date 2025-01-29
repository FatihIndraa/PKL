@extends('dashboard.layout.template-home')
@section('konten')
    <style>
        .carousel-item img {
            width: 1600px;
            height: 600px;
            object-fit: cover;
        }
    </style>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('foto/julia-zyablova-S1v7hVUiCg0-unsplash.jpg') }}" class="d-block w-100 img-fluid"
                    alt="Hospital">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('foto/arseny-togulev-DE6rYp1nAho-unsplash.jpg') }}" class="d-block w-100 img-fluid"
                    alt="Medical">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('foto/usman-yousaf-pTrhfmj2jDA-unsplash.jpg') }}" class="d-block w-100 img-fluid"
                    alt="Doctor">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                @auth('web')
                    <h2 class="mb-4">Selamat datang di Medical, {{ Auth::guard('web')->user()->name }}</h2>
                @endauth
                @auth('dokters')
                    <h2 class="mb-4">Selamat datang di Medical, {{ Auth::guard('dokters')->user()->name }}</h2>
                @endauth
                @auth('operators')
                    <h2 class="mb-4">Selamat datang di Medical, {{ Auth::guard('operators')->user()->name }}</h2>
                @endauth
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquet felis vel velit pretium, sit amet
                    ultrices leo feugiat. Integer id nisi ac urna vestibulum rhoncus. Cras auctor nec sem vel finibus.
                    Integer volutpat erat at ipsum sollicitudin, vel scelerisque odio venenatis.</p>
                <p>Vestibulum dapibus justo vitae leo pulvinar scelerisque. Curabitur ut orci a libero tempus hendrerit.
                    Duis et semper ex. In hac habitasse platea dictumst. Nam ullamcorper tellus eget justo volutpat, eget
                    aliquet nisi consequat.</p>
                <p>Ut interdum, magna nec molestie elementum, ipsum metus pellentesque urna, in consectetur ipsum libero non
                    nisi. Donec elementum sapien a ex pharetra, sit amet aliquam purus pellentesque. Duis sit amet nulla
                    ligula. Duis id enim a ex vehicula consequat eget et tortor.</p>
            </div>
            @auth('web')
                <div class="col-lg-4">
                    <form action="{{ url('/dashboard/tambah-rekam-medis') }}" method="POST">
                        @csrf
                        @auth
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        @endauth
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama User</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ auth()->user()->name }}" readonly required>
                        </div>
                        <div class="mb-3">
                            <label for="dokter" class="form-label">Dokter</label>
                            <select class="form-select" id="dokter" name="dokter" required>
                                @foreach ($dokters as $dokter)
                                    <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="telp" class="form-label">Nomor yang bisa dihubungi</label>
                            <input type="text" class="form-control" id="telp" name="telp" pattern="[0-9]+"
                                title="Hanya boleh diisi dengan angka" required>
                        </div>
                        <div class="mb-3">
                            <label for="keluhan" class="form-label">Keluhan</label>
                            <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    @if (session('success'))
                        <div class="alert alert-success mt-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            @endauth
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="mb-4">Featured Content</h2>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="{{ asset('foto/hush-naidoo-jade-photography-yo01Z-9HQAw-unsplash.jpg') }}"
                        class="card-img-top" alt="Medical Image">
                    <div class="card-body">
                        <h5 class="card-title">Medical Article 1</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Read More
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="{{ asset('foto/spencer-davis-rxTTNlar62o-unsplash.jpg') }}" class="card-img-top"
                        alt="Hospital Image">
                    <div class="card-body">
                        <h5 class="card-title">Hospital News</h5>
                        <p class="card-text">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Read More
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="{{ asset('foto/spencer-davis-s4_g2TCyNHM-unsplash.jpg') }}" class="card-img-top"
                        alt="Doctor Image">
                    <div class="card-body">
                        <h5 class="card-title">Doctor's Advice</h5>
                        <p class="card-text">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                            aliquip ex ea commodo consequat.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Read More
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
