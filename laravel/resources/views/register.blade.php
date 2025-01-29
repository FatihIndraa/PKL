<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://source.unsplash.com/featured/?medical');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            filter: blur(7px);
            z-index: -1;
        }

        .card-register {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .register-container {
            width: 400px;
            height: 550px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="background-container"></div>
    <div class="card-register">
        <div class="register-container">
            <h1 class="text-center mb-4">Register</h1>
            <form action="/register" method="POST" onsubmit="return confirmRegistration()">
                @csrf
                <div class="mb-3">
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        id="name" placeholder="Name" required value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                        id="email" placeholder="Email" required value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                        id="password" placeholder="Password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <select class="form-control" name="gender" id="gender" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary btn-block" type="submit">Register</button>
                </div>
            </form>
            <div class="text-center">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </div>
    </div>


    <script>
        function confirmRegistration() {
            return confirm("Apakah Anda yakin ingin menyimpan data ini?");
        }
    </script>
</body>

</html>
