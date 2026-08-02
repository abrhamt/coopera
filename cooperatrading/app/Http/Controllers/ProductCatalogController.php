<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ProductCatalogController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')->orderBy('name')->get();
        return view('products.index', compact('categories'));
    }

    public function category(Category $category): View
    {
        $products = $category->products()->orderBy('name')->paginate(24);
        return view('products.category', compact('category', 'products'));
    }

    public function show(Category $category, Product $product): View
    {
        $related = Product::where('category_id', $category->id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();
        return view('products.show', compact('category', 'product', 'related'));
    }
}
