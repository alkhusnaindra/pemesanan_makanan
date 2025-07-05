<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data kategori filter
        $categoryId = $request->query('category');
        $meja = $request->query('meja'); // menangkap nomor meja jika ada di query

        if ($categoryId) {
            $menus = Menu::where('category_id', $categoryId)->get();
        } else {
            $menus = Menu::all();
        }

        $categories = Category::all();

        return view('order.menu', compact('menus', 'categories', 'categoryId', 'meja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu, Request $request)
    {
        $meja = $request->query('meja'); // kirim nomor meja ke view detail jika ada

        return view('menu.detail', compact('menu', 'meja'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
