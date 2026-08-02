@extends('layouts.app')

@section('title', $category->name)
@section('description', $category->description)

@section('content')
<section class="relative bg-slate-950 text-white min-h-[380px] lg:min-h-[420px] flex items-center overflow-hidden">
    <!-- Category Image Banner Background Layer -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="{{ asset('assets/images/categories/' . $category->slug . '.jpg') }}" alt="{{ $category->name }}" class="w-full h-full object-cover transform scale-105 opacity-60">
    </div>

    <!-- Dual-Tone Dark Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/90 to-indigo-950/80 z-10 pointer-events-none"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/90 via-slate-900/70 to-slate-950 z-10 pointer-events-none"></div>

    <!-- Content Container -->
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 w-full">
        <div class="max-w-3xl space-y-4">
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-slate-300 uppercase tracking-wider">
                <a href="{{ route('products') }}" class="hover:text-white transition">Products</a>
                <span class="text-slate-500">/</span>
                <span class="text-emerald-400 font-bold">{{ $category->name }}</span>
            </nav>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight text-white [text-shadow:_0_4px_24px_rgba(0,0,0,0.9)]">
                {{ $category->name }}
            </h1>
            <p class="text-lg lg:text-xl text-slate-200 leading-relaxed max-w-3xl [text-shadow:_0_2px_12px_rgba(0,0,0,0.85)]">
                {{ $category->description }}
            </p>
            <div class="pt-2">
                <a href="{{ route('quote.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white text-sm font-bold shadow-lg shadow-emerald-500/20 hover:scale-105 transform cursor-pointer transition">
                    Request Proforma for {{ $category->name }}
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <a href="{{ route('products.show', [$category, $product]) }}" class="group flex flex-col justify-between bg-white border border-slate-200 rounded-2xl overflow-hidden hover:border-indigo-600 hover:shadow-xl transition-all duration-300">
                        <div class="aspect-[4/3] w-full bg-slate-100 overflow-hidden">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
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
