@extends('dashboard.layout.template')

@section('content')
    <!-- Main Content -->

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                @if (auth()->user()->role == 'admin')
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
                                <p class="text-sm mb-0">Total Pemesanan</p>
                                <h4 class="mb-0">{{ $totalOrders }}</h4>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3">
                            <p class="text-sm mb-0">Total Paket</p>
                            <h4 class="mb-0">{{ $totalPackages }}</h4>
                        </div>
                    </div>
                </div>

            </div>
            @if (auth()->user()->role == 'admin')
                <div class="row mt-4">
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
            @endif
        </div>
    </main>
@endsection
