<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::where('is_active', true)
            ->whereNotNull('compare_price')
            ->with('category')
            ->take(4)
            ->get();

        $newArrivals = Product::where('is_active', true)
            ->latest()
            ->with('category')
            ->take(8)
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('home', compact('featuredProducts', 'newArrivals', 'categories'));
    }

    public function productShow(Product $product): View
    {
        $product->load('category');
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function categoryShow(Category $category, Request $request): View
    {
        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->with('category')
            ->latest()
            ->paginate(12);

        return view('categories.show', compact('category', 'products'));
    }
}
