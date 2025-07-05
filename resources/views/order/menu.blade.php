<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Menu Pelanggan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    body {
      background-color: #FFF7F7;
      font-family: 'Poppins', sans-serif;
    }

    .nomor-meja {
      font-size: 1rem;
      font-weight: 300;
      border-radius: 12px !important;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .search-input {
      border-radius: 12px;
      font-size: 1rem;
      padding: 12px 20px;
      background-color: #fff;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      border: none;
    }

    .kategori-scroll-wrapper {
      display: flex;
      overflow-x: auto;
      white-space: nowrap;
      padding-bottom: 6px;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
    }
    .kategori-scroll-wrapper::-webkit-scrollbar {
      display: none;
    }

    .btn-kategori {
      flex-shrink: 0;
      border-radius: 12px;
      margin-right: 8px;
      font-size: 0.9rem;
      color: #000;
      border: 1px solid #000;
      padding: 6px 12px;
      font-family: 'Poppins', sans-serif;
      text-decoration: none;
      background-color: transparent;
      transition: all 0.2s ease-in-out;
     }

     .btn-kategori.active {
        background-color: #6F4E37;
        color: #FFFFFF;
        border-color: #6F4E37;
     }


    .menu-card {
  border-radius: 16px;
  overflow: hidden;
  background: #EFEFEF;
  border: 2px solid transparent;
  position: relative;
  padding: 8px;
  transition: all 0.3s ease; /* Transisi semua perubahan, bukan hanya border */
  cursor: pointer;
}
    /* Efek hover border */
    .menu-card:hover {
      border: 2px solid #6F4E37;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .menu-card img {
      width: 100%;
      height: auto;
      max-height: 160px;
      object-fit: cover;
      border-radius: 12px;
      pointer-events: none; /* supaya klik tidak di trigger oleh gambar */
    }
    .menu-card:active {
  border: 2px solid #6F4E37;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}


    .badge-status {
      border-radius: 14px;
      padding: 6px 12px;
      font-size: 0.8rem;
      font-weight: 600;
    }
    .tersedia {
      background-color: #05BA05;
      color: #fff;
    }
    .habis {
      background-color: #D7001C;
      color: #fff;
    }

    .btn-keranjang {
      background-color: #6F4E37;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 0.75rem;
      padding: 4px 8px;
      cursor: pointer;
      width: 100%;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .btn-keranjang:disabled {
      background-color: #ccc;
      color: #666;
      cursor: not-allowed;
    }

    .btn-deskripsi {
      position: absolute;
      top: 8px;
      left: 8px;
      background: rgba(0, 0, 0, 0.6);
      color: white;
      border-radius: 50%;
      width: 28px;
      height: 28px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-decoration: none;
      z-index: 10;
      cursor: pointer;
    }
    .btn-deskripsi:hover {
      background: rgba(0, 0, 0, 0.8);
    }

    /* Kontrol jumlah */
    .qty-control {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 6px;
      margin-bottom: 8px;
    }
    .qty-control button {
      background-color: #6F4E37;
      color: white;
      border: none;
      border-radius: 4px;
      width: 28px;
      height: 28px;
      font-size: 1rem;
      line-height: 1;
      cursor: pointer;
      user-select: none;
    }
    .qty-control input {
      width: 40px;
      text-align: center;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 0.9rem;
      padding: 2px 4px;
      user-select: none;
    }
     @media (max-width: 430px) {
  .qty-control {
    justify-content: space-between !important;
    width: 100%;
  }

  .qty-control input {
    width: 36px;
  }

  .btn-keranjang {
    font-size: 0.75rem;
    padding: 6px 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 4px;
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
    .cart-badge {
  position: absolute;
  top: 8px;
  right: 8px;
  background: linear-gradient(135deg, #3f87a6, #ebf8e1);
  color: #fff;
  border-radius: 50%;
  font-size: 0.75rem;
  width: 22px;
  height: 22px;
  display: flex;
  justify-content: center;
  align-items: center;
  user-select: none;
  box-shadow: 0 0 6px rgba(0, 0, 0, 0.25);
  font-weight: bold;
  transition: transform 0.2s ease, background 0.3s ease;
}
.cart-badge:hover {
  transform: scale(1.15);
  background: linear-gradient(135deg, #1e90ff, #d4fc79);
}


    @media (max-width: 576px) {
      .btn-keranjang {
        font-size: 0.7rem;
        padding: 3px 6px;
      }

      .menu-card {
        padding: 6px;
      }

      .menu-card img {
        height: 120px;
      }

      .badge-status {
        font-size: 0.7rem;
        padding: 4px 8px;
      }
      .qty-control button {
        width: 24px;
        height: 24px;
      }
      .qty-control input {
        width: 32px;
      }
    }
    .scrollable-content {
      overflow-y: auto;
      padding-bottom: 80px;
      max-height: calc(100vh - 240px); 
    }
    /* Style pesan menu tidak tersedia */
    #noResultsMessage {
      text-align: center;
      font-style: italic;
      color: #888;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<div class="container-fluid px-3 pt-4 pb-5">
  
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h5 class="fw-bold mb-0">Selamat datang di</h5>
      <h5 class="fw-bold">Bilik_CoffeHouse</h5>
    </div>
    @if(isset($meja))
      <button class="btn btn-outline-secondary px-3 py-1 nomor-meja">
        Meja {{ $meja->nomor_meja }}
      </button>
    @endif
  </div>

  <!-- Search -->
  <div class="mb-3">
    <input type="text" id="searchInput" class="search-input w-100" placeholder="Cari Menu..." autocomplete="off" />
  </div>

  <!-- Kategori -->
  <div class="mb-3">
    <strong class="d-block mb-2">Kategori</strong>
    <div class="kategori-scroll-wrapper">
      <a href="{{ url()->current() }}" class="btn-kategori {{ is_null($categoryId) ? 'active' : '' }}">Semua</a>
      @foreach($categories as $category)
        <a href="{{ url()->current() }}?category={{ $category->id }}" 
           class="btn-kategori {{ $categoryId == $category->id ? 'active' : '' }}">
           {{ $category->name }}
        </a>
      @endforeach
    </div>
  </div>

  <!-- Menu -->
   <div class="mb-3">
    <strong class="d-block mb-2">Menu</strong>
    <div class="scrollable-content">
      <div id="menuContainer" class="row row-cols-2 row-cols-sm-2 row-cols-md-3 g-3">
        @forelse($menus as $menu)
          <div class="col menu-item" data-category="{{ $menu->category_id }}">
            <div class="menu-card shadow-sm" data-menu-id="{{ $menu->id }}" onclick="this.classList.toggle('active')">
              <a href="javascript:void(0)" class="btn-deskripsi" title="Lihat Deskripsi" data-menu-id="{{ $menu->id }}">
                <i class="bi bi-info-circle"></i>
              </a>
              <img src="{{ asset('storage/' . $menu->gambar) }}" class="img-fluid mb-2" alt="{{ $menu->nama }}" />
              <div class="px-1">
                <p class="fw-semibold mb-1 small">{{ $menu->nama }}</p>
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="text-muted small">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                  <span class="badge-status {{ $menu->status_menu == 'tersedia' ? 'tersedia' : 'habis' }}">
                    {{ ucfirst($menu->status_menu) }}
                  </span>
                </div>

                <!-- Kontrol jumlah -->
                <div class="d-flex flex-column flex-sm-row align-items-stretch gap-2 mb-2">
                <!-- Kontrol Jumlah -->
                <div class="qty-control justify-content-center">
                  <button type="button" class="qty-minus" aria-label="Kurangi">-</button>
                  <input type="text" class="qty-input" value="1" readonly />
                  <button type="button" class="qty-plus" aria-label="Tambah">+</button>
                </div>

                <!-- Tombol Tambah ke Keranjang -->
                   <form class="add-to-cart-form w-100" action="{{ route('cart.add', $menu->id) }}" method="POST">
                      @csrf
                   <input type="hidden" name="quantity" class="input-quantity" value="1" />
                      <button type="submit" class="btn-keranjang" {{ $menu->status_menu == 'tersedia' ? '' : 'disabled' }}>
                      <i class="bi bi-cart-plus me-1"></i> Tambah
                      </button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <p class="text-center text-muted">Menu tidak ditemukan untuk kategori ini.</p>
          </div>
        @endforelse
      </div>
      <p id="noResultsMessage" style="display:none;">Menu tidak tersedia.</p>
    </div>
  </div>
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

<!-- Modal Detail Menu -->
<div class="modal fade" id="detailMenuModal" tabindex="-1" aria-labelledby="detailMenuLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content font-poppins">
      <div class="modal-header">
        <h5 class="modal-title" id="detailMenuLabel">Detail Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img id="modalImage" src="" alt="" class="img-fluid rounded mb-3" />
        <h5 id="modalName"></h5>
        <p id="modalDescription"></p>
        <p><strong>Harga:</strong> <span id="modalPrice"></span></p>
        <p><strong>Status:</strong> <span id="modalStatus"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Cari elemen dan event listener untuk pencarian
  const searchInput = document.getElementById('searchInput');
  const menuItems = document.querySelectorAll('.menu-item');
  const noResultsMessage = document.getElementById('noResultsMessage');
  const cartCountBadge = document.getElementById('cartCount');
  let cartCount = 0; // jumlah item di keranjang (bisa disesuaikan backend)

  // Fungsi filter menu berdasarkan pencarian
  searchInput.addEventListener('input', () => {
    const keyword = searchInput.value.toLowerCase();
    let visibleCount = 0;
    menuItems.forEach(item => {
      const name = item.querySelector('p').innerText.toLowerCase();
      if (name.includes(keyword)) {
        item.style.display = 'block';
        visibleCount++;
      } else {
        item.style.display = 'none';
      }
    });
    noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
  });

  // Kontrol jumlah (-/+) di tiap menu
  document.querySelectorAll('.menu-card').forEach(card => {
    const minusBtn = card.querySelector('.qty-minus');
    const plusBtn = card.querySelector('.qty-plus');
    const qtyInput = card.querySelector('.qty-input');
    const hiddenQty = card.querySelector('.input-quantity');

    minusBtn.addEventListener('click', () => {
      let currentVal = parseInt(qtyInput.value);
      if (currentVal > 1) {
        qtyInput.value = currentVal - 1;
        hiddenQty.value = qtyInput.value;
      }
    });
    plusBtn.addEventListener('click', () => {
      let currentVal = parseInt(qtyInput.value);
      qtyInput.value = currentVal + 1;
      hiddenQty.value = qtyInput.value;
    });
  });

  // Notifikasi tambah ke keranjang
  document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', e => {
    

      // Ambil data menu dan qty
      const menuCard = form.closest('.menu-card');
      const menuName = menuCard.querySelector('p').innerText;
      const qty = form.querySelector('.input-quantity').value;

      // Update badge jumlah keranjang (tambah qty)
      cartCount += parseInt(qty);
      cartCountBadge.innerText = cartCount;
      cartCountBadge.style.display = 'flex';

      // Tampilkan alert sukses
      alert('Menu Sudah Berhasil Ditambahkan ke Keranjang');

      // Kalau mau redirect atau reset qty, bisa diatur di sini
      hiddenQty.value = qty;

    });
  });

  // Navigasi bottom nav
  document.getElementById('btnHome').addEventListener('click', () => {
    window.location.href = '/meja-{nomor_meja}';
  });
  document.getElementById('btnCart').addEventListener('click', () => {
    window.location.href = '/cart';
  });
  document.getElementById('btnPayment').addEventListener('click', () => {
    window.location.href = '/payment/confirm';
  });

  // Modal detail menu
  const detailModal = new bootstrap.Modal(document.getElementById('detailMenuModal'));
  const modalName = document.getElementById('modalName');
  const modalDescription = document.getElementById('modalDescription');
  const modalPrice = document.getElementById('modalPrice');
  const modalStatus = document.getElementById('modalStatus');
  const modalImage = document.getElementById('modalImage');

  const menusData = {
    @foreach($menus as $menu)
      "{{ $menu->id }}": {
        name: @json($menu->nama),
        description: @json($menu->deskripsi ?? 'Deskripsi tidak tersedia'),
        price: "Rp {{ number_format($menu->harga, 0, ',', '.') }}",
        status: "{{ ucfirst($menu->status_menu) }}",
        image: "{{ asset('storage/' . $menu->gambar) }}"
      },
    @endforeach
  };

  // Event klik ikon info
  document.querySelectorAll('.btn-deskripsi').forEach(btn => {
    btn.addEventListener('click', e => {
      e.stopPropagation(); // supaya gak trigger klik menu-card
      const id = btn.getAttribute('data-menu-id');
      if(menusData[id]){
        modalName.innerText = menusData[id].name;
        modalDescription.innerText = menusData[id].description;
        modalPrice.innerText = menusData[id].price;
        modalStatus.innerText = menusData[id].status;
        modalImage.src = menusData[id].image;
        detailModal.show();
      }
    });
  });

</script>
</body>
</html>