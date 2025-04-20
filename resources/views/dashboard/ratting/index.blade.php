@extends('dashboard.layout.template')

@section('content')
    <div class="container" style="margin-top: 10px;">
        <h2 class="text-center mb-4">Statistik Ratting Pengguna</h2>

        <div class="row justify-content-center mb-4">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <p><strong>Total Ulasan:</strong> {{ $totalRatting }}</p>
                            <p><strong>Rata-rata Bintang:</strong> {{ $averageRatting }} ⭐</p>
                        </div>

                        <!-- Chart -->
                        <canvas id="rattingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="text-center mb-4">Semua Ulasan</h4>
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                @forelse($rattings as $ratting)
                    <div class="border p-3 mb-3 rounded shadow-sm">
                        <strong>{{ $ratting->user->name }}</strong>
                        <p class="mb-1">Rating: {{ $ratting->rating }} ⭐</p>
                        <p>Komentar: {{ $ratting->komentar ?? '-' }}</p>
                    </div>
                @empty
                    <p class="text-center">Belum ada ulasan.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('rattingChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['⭐ 1', '⭐ 2', '⭐ 3', '⭐ 4', '⭐ 5'],
                datasets: [{
                    label: 'Jumlah Penilaian',
                    data: [
                        {{ $rattingCounts[1] ?? 0 }},
                        {{ $rattingCounts[2] ?? 0 }},
                        {{ $rattingCounts[3] ?? 0 }},
                        {{ $rattingCounts[4] ?? 0 }},
                        {{ $rattingCounts[5] ?? 0 }}
                    ],
                    backgroundColor: [
                        '#ff6384', '#ff9f40', '#ffcd56', '#4bc0c0', '#36a2eb'
                    ],
                    borderRadius: 10,
                    barThickness: 20
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Distribusi Rating Pengguna'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            max: Math.max(...[
                                {{ $rattingCounts[1] ?? 0 }},
                                {{ $rattingCounts[2] ?? 0 }},
                                {{ $rattingCounts[3] ?? 0 }},
                                {{ $rattingCounts[4] ?? 0 }},
                                {{ $rattingCounts[5] ?? 0 }}
                            ]) + 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endsection
