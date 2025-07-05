<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use App\Models\Pesanan;  // pastikan ini sudah import

class PaymentController extends Controller
{
    public function show()
    {
        return view('payment.confirm');
    }

    public function submit(Request $request)
    {
        $metode = $request->input('metode');
        $catatan = $request->input('catatan');
        


        $cart = session('cart', []);
        $nomor_meja = session('nomor_meja');

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong, tidak ada pesanan.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Simpan data pesanan ke database
        Pesanan::create([
            'meja' => $nomor_meja,
            'catatan' => $catatan,
            'metode_pembayaran' => $metode,
            'total_harga' => $total,
            // Tambahkan kolom lain jika perlu, seperti user_id, status, dsb
        ]);

        // Kosongkan keranjang setelah submit
        session()->forget('cart');
        session()->forget('meja');

        return redirect()->route('home')->with('success', 'Pesanan berhasil dikonfirmasi!');
    }
}

