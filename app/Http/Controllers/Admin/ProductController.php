<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('admin.create_product');
    }

    public function storeMultiple(Request $request)
    {
        $request->validate([
            'products.*.name' => 'required',
            'products.*.price' => 'required|numeric',
            'products.*.image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'products.*.category' => 'required'
        ]);
    
        foreach ($request->products as $productData) {
            // Simpan file gambar
            $imageName = time() . '_' . $productData['name'] . '.' . $productData['image']->extension();
            $productData['image']->storeAs('products', $imageName, 'public');
    
            // Simpan data produk ke database
            Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'image_url' => $imageName, // Simpan path gambar
                'category' => $productData['category']
            ]);
        }
    
        return redirect()->back()->with('success', 'Products added successfully.');
    }
    

    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }
}
