<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="bg-secondary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>

@extends('dashboard.layout.template')

@section('konten')
    <div class="table-responsive">
        <div class="container-sm col-6 my-3 rounded px-5 py-3 pb-5">
            <div class="card shadow">

                <div class="card-header bg-primary text-white">Tambah Dokter</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success mt-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="text-center" action="/dashboard/tambah-dokter" method="post">
                        @csrf
                        <div class="mb-3"><input
                                class="form-control @error('name')
                                is-invalid
                            @enderror"
                                type="text" name="name" id="name" placeholder="Name" required
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3"><input
                                class="form-control @error('email')
                                is-invalid
                            @enderror"
                                type="email" name="email" id="email" placeholder="Email" required
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3"><input
                                class="form-control @error('password')
                                is-invalid
                            @enderror"
                                type="password" name="password" id="password" placeholder="Password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
