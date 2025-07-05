@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container py-3 font-poppins">
    {{-- Header --}}
    @php
        $lastMenuId = session('last_menu_id');
    @endphp

    <div class="d-flex align-items-center mb-4">
        <a href="{{ $lastMenuId ? route('menu.detail', ['menu' => $lastMenuId]) : route('menu.index') }}" class="text-decoration-none text-dark me-2">
            <i class="bi bi-arrow-left fs-4"></i>
        </a>
        <h5 class="fw-bold mb-0">Keranjang</h5>
    </div>

    {{-- Keranjang --}}
    @if(session('cart') && count(session('cart')) > 0)
        @php $total = 0; @endphp

        @foreach(session('cart') as $id => $item)
            @php $total += $item['price'] * $item['quantity']; @endphp
            <div class="card mb-3 shadow-sm rounded-4">
                <div class="card-body d-flex justify-content-between align-items-start flex-wrap">
                    {{-- Gambar --}}
                    @if ($item['image'])
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="rounded me-3" width="70" height="70">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" alt="Placeholder gambar" class="rounded me-3" width="70" height="70">
                    @endif

                    {{-- Info --}}
                    <div class="flex-grow-1">
                        <h6 class="mb-1">{{ $item['name'] }}</h6>
                        <p class="text-muted small mb-0">Rp. {{ number_format($item['price'], 0, ',', '.') }}</p>
                    </div>

                    {{-- Tombol Jumlah --}}
                    <div class="cart-action-col">
                        <div class="trash-wrapper mb-2">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm text-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>

                        <div class="quantity-wrapper d-flex align-items-center">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="me-1">
                                @csrf
                                <input type="hidden" name="action" value="decrement">
                                <button class="btn btn-sm btn-outline-secondary">-</button>
                            </form>

                            <span class="mx-2">{{ $item['quantity'] }}</span>

                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="increment">
                                <button class="btn btn-sm btn-outline-secondary">+</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Total dan Tombol Checkout --}}
        <div class="d-flex justify-content-between align-items-center mt-4">
            <strong>Total Harga :</strong>
            <strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong>
        </div>

        <div class="d-grid mt-3">
            <a href="{{ route('payment.confirm') }}" class="btn btn-checkout rounded-2 py-2">Bayar Sekarang</a>
        </div>
    @else
        <p class="text-center">Keranjang Anda kosong.</p>
    @endif
</div>

    <!-- Bottom Navigation -->
        <div class="bottom-nav">
          <i id="btnHome" class="bi bi-house-door-fill" title="Beranda"></i>
            <div style="position:relative;">
               <i id="btnCart" class="bi bi-cart-fill" title="Keranjang"></i>
                <span id="cartCount" class="cart-badge" style="display:none;">0</span>
            </div>
          <i id="btnPayment" class="bi bi-receipt" title="Pembayaran"></i>
        </div>
    </div>

{{-- Style --}}
<style>
    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }

    .btn-checkout {
        background-color: #5A3E2A;
        color:rgb(255, 255, 255);
        transition: all 0.3s ease-in-out;
        border: none;
    }

    .btn-checkout:hover {
        background-color:rgb(112, 70, 39);
        color:rgb(255, 255, 255);
        box-shadow: 0 4px 8px rgba(243, 240, 240, 0.15);
    }

    .cart-action-col {
        min-width: 100px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
    }

    .trash-wrapper {
        margin-bottom: 0.5rem;
    }

    @media (max-width: 576px) {
        .cart-action-col {
            width: 100%;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 1rem;
        }

        .trash-wrapper {
            order: 1;
            margin-bottom: 0.5rem;
        }

        .quantity-wrapper {
            order: 2;
        }

        .quantity-wrapper form {
            margin-bottom: 0 !important;
        }
    }

    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #6F4E37;
        height: 60px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
        z-index: 1000;
        color: white;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
    }

    .bottom-nav i {
        color: white;
        font-size: 24px;
        cursor: pointer;
    }

    .bottom-nav i:hover {
        color: #d1b89d;
    }
</style>
@endsection
@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Form add to cart
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
      form.addEventListener('submit', e => {
        const menuCard = form.closest('.menu-card');
        const menuName = menuCard?.querySelector('p')?.innerText || 'Menu';
        const qty = form.querySelector('.input-quantity')?.value || 1;

        console.log(`Menambahkan ${qty} ${menuName} ke keranjang.`);
      });
    });

    // Navigasi bottom nav
    document.getElementById('btnHome')?.addEventListener('click', () => {
      window.location.href = '/meja-{nomor_meja}';
    });
    document.getElementById('btnCart')?.addEventListener('click', () => {
      window.location.href = '/cart';
    });
    document.getElementById('btnPayment')?.addEventListener('click', () => {
      window.location.href = '/payment/confirm';
    });
  });
</script>
@endsection
