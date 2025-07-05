@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
<div class="container py-3 font-poppins">
    {{-- Header --}}
    <div class="d-flex align-items-center mb-3">
        <a href="{{ url()->previous() }}" class="text-decoration-none text-dark me-2">
            <i class="bi bi-arrow-left fs-4"></i>
        </a>
        <h5 class="fw-bold mb-0">Konfirmasi Pembayaran</h5>
    </div>

    {{-- Meja --}}
    <h4 class="fw-bold text-center">Meja {{ session('nomor_meja') }}</h4>
    <hr class="my-2 divider-center">
    <p class="text-center text-muted mb-4">Silakan lakukan pembayaran</p>

    {{-- Rincian Harga --}}
    <h6 class="fw-bold">Rincian Harga</h6>
    <div class="border rounded-4 p-3 mb-4 rincian-box">
        @php $total = 0; @endphp

        @if(session('cart'))
            @foreach(session('cart') as $item)
                <div class="d-flex justify-content-between mb-2 rincian-item">
                    <span>{{ $item['name'] }}</span>
                    <span>Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                    @php $total += $item['price'] * $item['quantity']; @endphp
                </div>
            @endforeach

            <hr>
            <div class="d-flex justify-content-between fw-bold rincian-total">
                <span>Total Pembayaran</span>
                <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        @else
            <p>Keranjang kosong.</p>
        @endif
    </div>

    {{-- Catatan --}}
    <form action="{{ route('payment.submit') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="catatan" class="form-label fw-bold">Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control rounded-4 bg-light border-0" rows="3" placeholder="Tambahkan catatan (Opsional)"></textarea>
        </div>

        {{-- Metode Pembayaran --}}
        <h6 class="fw-bold mb-3">Metode Pembayaran</h6>

        <div class="d-grid gap-3">

            {{-- Bayar Online --}}
            <a href="{{ route('checkout') }}" class="btn btn-bayarOnline custom-rounded d-block text-center">
            <i class="bi bi-credit-card me-2"></i> Bayar online
            </a>


            {{-- Bayar di Kasir --}}
            <a href="{{ route('payment.cashier') }}" class="btn-bayarKasir custom-rounded d-block text-center">
                <i class="bi bi-wallet2 me-2"></i> Bayar di kasir
            </a>
        </div>
    </form>
</div>

{{-- Tambahan Style --}}
<style>
    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }

    .divider-center {
        width: 40%;
        margin: 0 auto;
    }

    .btn-bayarOnline {
        background-color: #5C3A2E;
        color: white;
        font-weight: 600;
        padding: 0.6rem 1.2rem;
        transition: all 0.3s ease-in-out;
        text-align: center;
    }

    .btn-bayarOnline:hover {
        background-color:rgb(112, 78, 65);
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .custom-rounded {
    border-radius: 8px;
    }
    
    .btn-bayarKasir {
        background-color: #5C3A2E;
        color: white;
        font-weight: 600;
        padding: 0.6rem 1.2rem;
        transition: all 0.3s ease-in-out;
        text-align: center;
    }

    .btn-bayarKasir:hover {
        background-color:rgb(112, 78, 65);
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }



    .rincian-box {
        background-color: #fffefc;
    }

    .rincian-item span {
        font-size: 0.95rem;
    }

    .rincian-total span {
        font-size: 1rem;
    }
</style>
@endsection
