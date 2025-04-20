@extends('layout.head')
@include('layout.navbar')

<style>
    .rating {
        direction: rtl;
        unicode-bidi: bidi-override;
        display: inline-flex;
        gap: 5px;
    }

    .rating input[type="radio"] {
        display: none;
    }

    .rating label {
        font-size: 5rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.2s;
    }

    .rating input[type="radio"]:checked~label {
        color: #ffc107;
    }

    .rating label:hover,
    .rating label:hover~label {
        color: #ffdb70;
    }
</style>

<div class="container py-5" style="margin-top: 100px;">
    <h2 class="mb-4 text-center">Beri Penilaian</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('ratting.store') }}" method="POST">
                @csrf
                <div class="mb-3 text-center">
                    <label for="rating" class="form-label d-block mb-2">Rating Anda</label>
                    <div class="rating justify-content-center">
                        @for ($i = 5; $i >= 1; $i--)
                            <input type="radio" name="rating" id="star{{ $i }}"
                                value="{{ $i }}">
                            <label for="star{{ $i }}">&#9733;</label>
                        @endfor
                    </div>
                </div>
                <div class="mb-3">
                    <label for="komentar" class="form-label">Komentar</label>
                    <textarea name="komentar" class="form-control" rows="3"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <hr class="my-5">

    <h4 class="text-center mb-4">Ulasan Pengguna</h4>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse($rattings as $ratting)
                <div class="border p-3 my-2 rounded">
                    <strong>{{ $ratting->user->name }}</strong>
                    <p>Rating: {{ $ratting->rating }} ⭐</p>
                    <p>Komentar: {{ $ratting->komentar ?? '-' }}</p>
                </div>
            @empty
                <p class="text-center">Belum ada ulasan.</p>
            @endforelse
        </div>
    </div>
</div>
