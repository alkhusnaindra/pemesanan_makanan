@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center">
        <div class="mb-4">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
        </div>
        <h1 class="fw-bold text-success">Pembayaran Berhasil!</h1>
        <p class="mt-3 fs-5 text-secondary">Terima kasih, pesanan Anda sedang diproses. Silakan tunggu di meja Anda.</p>
        <a href="{{ url('/') }}" class="btn btn-outline-success mt-4">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Menu
        </a>
    </div>
</div>
@endsection
