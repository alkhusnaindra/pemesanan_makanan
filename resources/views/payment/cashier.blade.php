@extends('layouts.app')

@section('title', 'Pembayaran Kasir')

@section('content')
<div class="container py-4 text-center font-poppins">

    {{-- Meja --}}
    <h3 class="fw-bold">Meja {{ session('nomor_meja') }}</h3>
    <hr style="width: 40px; margin: 0 auto; border: 2px solid #9b6b4d;" class="mb-2">
    <p class="text-muted" style="color: #9b6b4d;">Silahkan lakukan pembayaran di kasir</p>

    {{-- Ilustrasi --}}
    <img src="{{ asset('images/bilik-image-kasir.png') }}" alt="Bayar di kasir" class="img-fluid my-4 ilustrasi-bayar">

    {{-- Tombol Bayar/Selesai --}}
    <form method="POST" onsubmit="event.preventDefault(); handleButtonClick();">
        @csrf
        <button type="submit" id="btnBayar" class="btn btn-selesai rounded-pill px-4 py-2">
            <i class="bi bi-credit-card me-2"></i> Bayar Sekarang
        </button>
    </form>

    {{-- Popup Berhasil --}}
    <div id="popupBerhasil" class="popup-berhasil">
        <div class="popup-content shadow rounded-4 p-4 text-center bg-white">
            <div class="fs-1 mb-2 text-success">🎉</div>
            <h5 class="fw-bold mb-1">Pembayaran Selesai!</h5>
            <p class="text-muted mb-0">Silakan tunggu, pesanan Anda sedang diproses.</p>
        </div>
    </div>
</div>

{{-- Custom Styling --}}
<style>
    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }

    .btn-selesai {
        background-color:rgb(255, 255, 255);
        color: #6F4E37;
        border: 2px solid #5C3A2E;
        font-weight: 600;
        transition: 0.3s ease-in-out;
    }

    .btn-selesai:hover {
        background-color: #6F4E37;
        color:rgb(255, 255, 255);
        transform: scale(1.03);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .ilustrasi-bayar {
        max-width: 300px;
    }

    .popup-berhasil {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .popup-berhasil.show {
        display: flex;
    }

    .popup-content {
        background-color: #fff;
        max-width: 350px;
        animation: popFade 0.3s ease-in-out;
    }

    @keyframes popFade {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>

{{-- JS --}}
<script>
    let sudahBayar = false;

    function handleButtonClick() {
        const btn = document.getElementById('btnBayar');
        const popup = document.getElementById('popupBerhasil');

        if (!sudahBayar) {
            sudahBayar = true;
            btn.innerHTML = '<i class="bi bi-check-circle me-2"></i> Selesai';
            popup.classList.add('show');

            setTimeout(() => {
                popup.classList.remove('show');
            }, 5000);
        } else {
            window.location.href = "{{ url('/meja-' . session('nomor_meja')) }}";
        }
    }
</script>
@endsection
