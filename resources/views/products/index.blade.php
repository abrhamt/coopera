@extends('layouts.app')

@section('title', 'Products')
@section('description', 'Browse our full catalog of construction, industrial chemicals, water solutions, packaging, technology, and export products.')

@section('content')
<section class="bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <span class="text-sm font-semibold text-indigo-400 uppercase tracking-wider">Catalog</span>
        <h1 class="mt-3 text-4xl lg:text-5xl font-bold tracking-tight">Our products</h1>
        <p class="mt-4 text-lg text-slate-300 max-w-2xl">
            Six categories, hundreds of products. Select a category to explore, or send a quote request for any combination of items.
        </p>
    </div>
</section>

<section class="py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('products.category', $category) }}" class="group block bg-white border border-slate-200 rounded-xl overflow-hidden hover:border-slate-900 hover:shadow-lg transition">
                    <div class="aspect-[16/9] bg-slate-100 overflow-hidden">
                        <img src="{{ asset('assets/images/categories/' . $category->slug . '.jpg') }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center\'><span class=\'text-7xl font-bold text-white/30\'>{{ substr($category->name, 0, 1) }}</span></div>'">
                    </div>
                    <div class="p-6">
                        <div class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">{{ $category->products_count }} products</div>
                        <h2 class="mt-2 text-xl font-semibold text-slate-900 group-hover:text-slate-700">{{ $category->name }}</h2>
                        <p class="mt-2 text-sm text-slate-600 line-clamp-2">{{ $category->description }}</p>
                        <span class="mt-4 inline-flex items-center text-sm font-medium text-slate-900 group-hover:underline">
                            View products →
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
