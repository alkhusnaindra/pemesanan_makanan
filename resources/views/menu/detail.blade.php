@extends('layouts.app')

@section('title', 'Detail Menu')

@section('content')
<div class="container mt-4 font-poppins">

    {{-- Tombol kembali --}}
    @php
        $previousUrl = url()->previous();
        if (str_contains($previousUrl, 'menu/') && isset($meja)) {
            $previousUrl = route('menu.index', ['meja' => $meja]);
        }
    @endphp
    <a href="{{ $previousUrl }}" class="text-decoration-none text-dark mb-3 d-flex align-items-center">
        <i class="bi bi-arrow-left me-2" style="color: #000;"></i>
        <strong>Deskripsi Menu</strong>
    </a>

    <div class="card border-0 shadow-sm p-3 rounded-4">
        {{-- Gambar --}}
        <div class="text-center mb-3">
            @if ($menu->gambar)
                <img src="{{ asset('storage/' . $menu->gambar) }}"
                     class="menu-img img-fluid rounded-3"
                     alt="{{ $menu->nama }}">
            @else
                <img src="{{ asset('images/placeholder.png') }}"
                     class="menu-img img-fluid rounded-3"
                     alt="Placeholder gambar">
            @endif
        </div>

        {{-- Nama, Kategori, Harga --}}
        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
            <div>
                <p class="mb-1 fw-bold text-muted small">{{ $menu->category->name ?? 'Kategori' }}</p>
                <h5 class="fw-medium fs-5">{{ $menu->nama }}</h5>
            </div>
            <div class="text-end">
                <h5 class="fw-medium fs-5">Rp{{ number_format($menu->harga, 0, ',', '.') }}</h5>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="mt-3">
            <h6 class="fw-semibold text-muted">Details</h6>
            <p class="text-secondary small mb-2">
                {{ $menu->deskripsi ?? 'Deskripsi tidak tersedia.' }}
            </p>
        </div>

        {{-- Form Tambah ke Keranjang --}}
        <form action="{{ route('cart.add', $menu->id) }}" method="POST">
            @csrf
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch gap-3 mt-4">

                {{-- Input Jumlah --}}
                <div class="flex-grow-1" style="max-width: 200px;">
                    <label for="quantity" class="form-label fw-semibold mb-1">Jumlah</label>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity(-1)">−</button>
                        <input type="number" name="quantity" id="quantity" class="form-control text-center" value="1" min="1" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="updateQuantity(1)">+</button>
                    </div>
                </div>

                {{-- Tombol Keranjang --}}
                <div class="flex-grow-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-brown rounded-pill px-4 py-2 animated-btn w-100 w-md-auto">
                        <i class="bi bi-cart me-2"></i> Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- Gaya --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }

    .menu-img {
        width: 100%;
        max-height: 220px;
        object-fit: cover;
    }

    .btn-brown {
        background-color: #6B3E26;
        color: white;
        transition: all 0.3s ease-in-out;
        font-size: 0.9rem;
    }

    .btn-brown:hover {
        background-color: #5A2F1D;
        color: #fff;
        transform: scale(1.03);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .animated-btn {
        transition: all 0.3s ease;
    }

    .animated-btn:hover {
        transform: scale(1.05);
    }

    @media (max-width: 576px) {
        .input-group {
            width: 100%;
        }

        .btn-brown {
            width: 100%;
        }

        .menu-img {
            max-height: 180px;
        }
    }
</style>

{{-- Script --}}
<script>
    function updateQuantity(change) {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value);
        if (!isNaN(value)) {
            value += change;
            if (value < 1) value = 1;
            input.value = value;
        }
    }
</script>
@endsection
