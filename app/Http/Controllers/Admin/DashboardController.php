<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'categories' => Category::count(),
            'products' => Product::count(),
            'pending_quotes' => QuoteRequest::where('status', 'pending')->count(),
            'processed_quotes' => QuoteRequest::where('status', 'processed')->count(),
        ];

        $recentQuotes = QuoteRequest::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentQuotes'));
    }
}
