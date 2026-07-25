<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProformaController;
use App\Http\Controllers\Admin\QuoteRequestController as AdminQuoteRequestController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCatalogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/products', [ProductCatalogController::class, 'index'])->name('products');
Route::get('/products/{category:slug}', [ProductCatalogController::class, 'category'])->name('products.category');
Route::get('/products/{category:slug}/{product:slug}', [ProductCatalogController::class, 'show'])->name('products.show');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/quote', [QuoteRequestController::class, 'create'])->name('quote.create');
Route::post('/quote', [QuoteRequestController::class, 'store'])->name('quote.store');
Route::get('/quote/thank-you', [QuoteRequestController::class, 'thankYou'])->name('quote.thank-you');

Route::get('/dashboard', function () {
    if (auth()->user()?->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);

    Route::get('quote-requests', [AdminQuoteRequestController::class, 'index'])->name('quote-requests.index');
    Route::get('quote-requests/{quoteRequest}', [AdminQuoteRequestController::class, 'show'])->name('quote-requests.show');

    Route::get('proformas/create/{quoteRequest}', [ProformaController::class, 'create'])->name('proformas.create');
    Route::post('proformas/create/{quoteRequest}', [ProformaController::class, 'store'])->name('proformas.store');
    Route::get('proformas/{proforma}', [ProformaController::class, 'show'])->name('proformas.show');
    Route::get('proformas/{proforma}/download', [ProformaController::class, 'download'])->name('proformas.download');
    Route::get('proformas/{proforma}/stream', [ProformaController::class, 'stream'])->name('proformas.stream');
});

Route::get('/proformas/{proforma:proforma_number}/verify', [ProformaController::class, 'verify'])
    ->middleware('signed')
    ->name('proformas.verify');

require __DIR__.'/auth.php';
