<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    // Menampilkan daftar produk 
    public function index()
    {
        // Ambil data product dengan pagination. Misal: 5 item per halaman
        $products = Product::latest()->paginate(5);

        // Kirim data ke file Vue 'Product/Index.vue' melalui Inertia::render
        return Inertia::render('Product/Index', [
            'products' => $products,
        ]);
    }

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        // Hanya render file 'Product/Create.vue' tanpa data tambahan
        return Inertia::render('Product/Create');
    }

    // Menangani proses simpan data produk baru
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        // Simpan data ke database
        Product::create($validated);

        // Kembali ke halaman daftar produk (products.index)
        return to_route('products.index');
    }

    // Menampilkan detail satu produk
    public function show(Product $product)
    {
        // Kirim data produk ke file 'Product/Show.vue'
        return Inertia::render('Product/Show', [
            'product' => $product,
        ]);
    }

    // Menampilkan form edit untuk produk tertentu
    public function edit(Product $product)
    {
        // Kirim data produk ke file 'Product/Edit.vue'
        return Inertia::render('Product/Edit', [
            'product' => $product,
        ]);
    }

    // Menangani proses update data produk
    public function update(Request $request, Product $product)
    {
        // Validasi data input
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        // Update data produk di database
        $product->update($validated);

        // Redirect kembali ke halaman daftar produk
        return to_route('products.index');
    }

    // Menghapus produk dari database
    public function destroy(Product $product)
    {
        // Hapus produk
        $product->delete();

        // Kembali ke halaman daftar produk
        return to_route('products.index');
    }
}
