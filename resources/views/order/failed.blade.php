@extends('layouts.app')

@section('title', 'Pembayaran Gagal')

@section('content')
<style>
  .failed-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff4f4;
    font-family: 'Poppins', sans-serif;
    padding: 2rem;
  }

  .failed-box {
    background-color: #ffe6e6;
    border: 2px solid #ff4d4d;
    border-radius: 16px;
    padding: 2rem;
    max-width: 500px;
    width: 100%;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .failed-title {
    color: #ff4d4d;
    font-size: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
  }

  .failed-desc {
    font-size: 1.1rem;
    color: #444;
    margin-bottom: 2rem;
  }

  .failed-btn {
    display: inline-block;
    background-color: #ff4d4d;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.3s ease;
  }

  .failed-btn:hover {
    background-color: #e60000;
  }
</style>

<div class="failed-container">
  <div class="failed-box">
    <div class="failed-title">Pembayaran Gagal</div>
    <div class="failed-desc">
      Kami tidak dapat memproses pembayaran Anda. Silakan coba lagi atau hubungi kasir.
    </div>
    <a href="/" class="failed-btn">Kembali ke Beranda</a>
  </div>
</div>
@endsection
