@extends('layouts.app')

@section('title', $category->name)
@section('description', $category->description)

@section('content')
<section class="relative bg-slate-900 text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('assets/images/categories/' . $category->slug . '.jpg') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/95 via-slate-900/80 to-slate-900/50"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <nav class="text-sm text-slate-300 mb-4">
            <a href="{{ route('products') }}" class="hover:text-white">Products</a>
            <span class="mx-2">/</span>
            <span class="text-white">{{ $category->name }}</span>
        </nav>
        <h1 class="text-4xl lg:text-5xl font-bold tracking-tight">{{ $category->name }}</h1>
        <p class="mt-4 text-lg text-slate-200 max-w-3xl">{{ $category->description }}</p>
        <div class="mt-6">
            <a href="{{ route('quote.create') }}" class="inline-flex items-center px-5 py-2.5 rounded-md bg-white text-slate-900 text-sm font-medium hover:bg-slate-100">
                Request a quote for these products
            </a>
        </div>
    </div>
</section>

<section class="py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <a href="{{ route('products.show', [$category, $product]) }}" class="group block bg-white border border-slate-200 rounded-xl overflow-hidden hover:border-slate-900 hover:shadow-lg transition">
                        <div class="aspect-square bg-slate-100 flex items-center justify-center overflow-hidden">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                            @else
                                <img src="{{ asset('assets/images/products/' . $product->slug . '.jpg') }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('assets/images/product-placeholder.jpg') }}'">
                            @endif
                        </div>
                        <div class="p-5">
                            <div class="text-xs font-medium text-slate-500 uppercase tracking-wider">per {{ $product->unit_of_measure }}</div>
                            <h3 class="mt-1 text-base font-semibold text-slate-900 group-hover:text-slate-700 line-clamp-2">{{ $product->name }}</h3>
                            <p class="mt-2 text-sm text-slate-600 line-clamp-2">{{ $product->description }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @else
            <p class="text-center text-slate-500 py-12">No products in this category yet.</p>
        @endif
    </div>
</section>
@endsection
