@extends('layouts.app')

@section('title', 'Pembayaran Pending')

@section('content')
<style>
    .pending-container {
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
        background-color: #fff8e1;
        padding: 20px;
    }

    .pending-box {
        text-align: center;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        max-width: 480px;
        width: 100%;
        border: 2px dashed #ffcc00;
    }

    .pending-icon {
        font-size: 64px;
        color: #ffcc00;
        margin-bottom: 20px;
    }

    .pending-title {
        font-size: 28px;
        font-weight: 700;
        color: #ff9900;
        margin-bottom: 10px;
    }

    .pending-desc {
        font-size: 16px;
        color: #555555;
        margin-bottom: 24px;
    }

    .pending-btn {
        padding: 10px 20px;
        background-color: #ffcc00;
        color: #000000;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .pending-btn:hover {
        background-color: #ffaa00;
    }

    @media (max-width: 600px) {
        .pending-box {
            padding: 30px 20px;
        }

        .pending-title {
            font-size: 22px;
        }

        .pending-icon {
            font-size: 48px;
        }
    }
</style>

<div class="pending-container">
    <div class="pending-box">
        <div class="pending-icon">⏳</div>
        <div class="pending-title">Pembayaran Pending</div>
        <div class="pending-desc">
            Kami sedang menunggu konfirmasi dari sistem pembayaran.<br>
            Silakan tunggu sebentar atau cek status pesanan Anda nanti.
        </div>
        <a href="{{ url('/') }}" class="pending-btn">Kembali ke Menu</a>
    </div>
</div>
@endsection
