<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->where('active', true)
            ->where('stock', '>', 0)
            ->whereNotNull('slug')
            ->latest()
            ->limit(6)
            ->get();
            
        $categories = Category::withCount('products')
            ->where('active', true)
            ->get();
            
        return view('home', [
            'featuredProducts' => $featuredProducts,
            'categories' => $categories
        ]);
    }
}
