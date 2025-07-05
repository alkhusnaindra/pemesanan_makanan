<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function showMenu(Request $request, $nomor_meja)
{
    $meja = Meja::where('nomor_meja', $nomor_meja)->firstOrFail();
    session(['nomor_meja' => $nomor_meja]);

    // Ambil kategori ID dari query string (misal ?category=1)
    $categoryId = $request->query('category');

    // Query menu dengan eager loading category, dan filter jika kategori dipilih
    $query = Menu::with('category');
    if ($categoryId) {
        $query->where('category_id', $categoryId);
    }
    $menus = $query->get();

    // Ambil semua kategori untuk navigasi filter
    $categories = Category::all();

    return view('order.menu', compact('meja', 'menus', 'categories', 'categoryId'));
}


    public function checkout()
    {
        $cart = session('cart');
        $meja_nomor = session('nomor_meja');
        $meja = Meja::where('nomor_meja', $meja_nomor)->first();

        if (!$cart || !$meja_nomor) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong atau meja tidak ditemukan');
        }
        if (!$meja) {
            return redirect()->back()->with('error', 'Nomor meja tidak ditemukan.');
        }
        $mejaId = $meja->id;

        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        $orderId = 'ORDER-' . time() . '-' . uniqid();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => 'Pelanggan Meja ' . $meja_nomor,
                'email' => 'meja' . $meja_nomor . '@example.com',
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        if (!$snapToken) {
            return redirect()->back()->with('error', 'Gagal mendapatkan token pembayaran');
        }

        $pesanan = Pesanan::create([
            'meja_id' => $mejaId,
            'status' => 'diproses',
            'status_pembayaran' => 'belum',
            'total_harga' => $total,
            'order_id' => $orderId,
            'snap_token' => $snapToken,
            'metode_pembayaran' => 'online'
        ]);

        return view('checkout.index', compact('cart', 'meja', 'snapToken'));
    }

    public function midtransCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash(
            "sha512",
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($hashed != $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $pesanan = Pesanan::where('order_id', $request->order_id)->first();

        if (!$pesanan) {
            return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
        }

        if ($request->transaction_status == 'settlement') {
            $pesanan->update([
                'status_pembayaran' => 'dibayar'
            ]);

            if (!PesananDetail::where('pesanan_id', $pesanan->id)->exists()) {
                $cart = session('cart') ?? []; // pastikan aman jika session habis
                foreach ($cart as $item) {
                    PesananDetail::create([
                        'pesanan_id' => $pesanan->id,
                        'menu_id' => $item['id'],
                        'jumlah' => $item['quantity'],
                        'subtotal' => $item['price'] * $item['quantity'],
                        'catatan' => $item['catatan'] ?? null,
                    ]);
                }
            }

            return response()->json(['message' => 'Pesanan diperbarui'], 200);
        }

        return response()->json(['message' => 'Transaksi belum berhasil'], 200);
    }

    public function checkoutOffline()
    {
        $cart = session('cart');
        $meja_nomor = session('nomor_meja');
        $meja = Meja::where('nomor_meja', $meja_nomor)->first();

        if (!$cart || !$meja) {
            return redirect()->back()->with('error', 'Keranjang kosong atau meja tidak ditemukan');
        }

        $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        $orderId = 'ORDER-' . time() . '-' . uniqid();

        $pesanan = Pesanan::create([
            'meja_id' => $meja->id,
            'status' => 'diproses',
            'status_pembayaran' => 'belum',
            'total_harga' => $total,
            'order_id' => $orderId,
            'metode_pembayaran' => 'offline'
        ]);

        foreach ($cart as $item) {
            PesananDetail::create([
                'pesanan_id' => $pesanan->id,
                'menu_id' => $item['id'],
                'jumlah' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
                'catatan' => $item['catatan'] ?? null,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('offline.success')->with('success', 'Pesanan berhasil dibuat dan akan dibayar di kasir.');
    }
}
