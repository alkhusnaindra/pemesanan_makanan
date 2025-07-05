<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Tambah menu ke keranjang
    public function addToCart(Request $request, $menuId)
{
    $menu = Menu::findOrFail($menuId);

    $cart = session()->get('cart', []);

    $quantity = $request->input('quantity', 1);

    if (isset($cart[$menuId])) {
        $cart[$menuId]['quantity'] += $quantity;
    } else {
        $cart[$menuId] = [
            'name' => $menu->nama,
            'price' => $menu->harga,
            'quantity' => $quantity,
            'image' => $menu->gambar
        ];
    }

    session()->put('cart', $cart);
    session()->put('last_menu_id', $menuId);

    if ($request->expectsJson()) {
        return response()->json(['success' => true]);
    }

    return redirect()->route('cart.index')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
}

    // Update quantity di keranjang
    public function updateQuantity(Request $request, $menuId)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$menuId])) {
            return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang');
        }

        if ($request->action === 'increment') {
            $cart[$menuId]['quantity']++;
        } elseif ($request->action === 'decrement') {
            $cart[$menuId]['quantity']--;
            if ($cart[$menuId]['quantity'] <= 0) {
                unset($cart[$menuId]);
            }
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Quantity berhasil diperbarui!');
    }

    // Hapus item dari keranjang
    public function removeItem($menuId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$menuId])) {
            unset($cart[$menuId]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
        }
        return redirect()->back()->with('error', 'Item tidak ditemukan.');
    }
}
