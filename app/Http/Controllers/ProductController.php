<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function showMenu()
    {
        $productsByCategory = Product::all()->groupBy('category');
        return view('menu', compact('productsByCategory'));
    }
}
