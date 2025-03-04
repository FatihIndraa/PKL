@extends('layout.head')
@include('layout.navbar')


<div class="container">
    <h2 class="text-center mb-4">Konfirmasi Pembayaran</h2>
    <p class="text-muted">Silakan lakukan pembayaran ke akun DANA berikut:</p>

    <div class="alert alert-info">
        <strong>Nomor DANA:</strong> 0895381191380 <br>
        <strong>Total Bayar:</strong> IDR {{ number_format($pemesanan->paket->harga, 0, ',', '.') }}
    </div>

    <form action="{{ route('pembayaran.upload', $pemesanan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label class="form-label">Unggah Bukti Pembayaran</label>
        <input type="file" name="bukti_pembayaran" class="form-control" required>

        <button type="submit" class="btn btn-primary mt-3">Kirim Bukti Pembayaran</button>
    </form>
</div>
