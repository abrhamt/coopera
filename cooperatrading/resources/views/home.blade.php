@extends('layouts.app')

@section('title', 'Home')
@section('description', 'Cooper Trading — your trusted partner for construction, industrial chemicals, water solutions, packaging, technology, and export products across Ethiopia and beyond.')

@section('content')
<section class="relative bg-slate-900 text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('assets/images/hero.jpg') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/95 via-slate-900/75 to-slate-900/40"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="max-w-3xl">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/10 text-white border border-white/20 mb-6">
                Trusted B2B Trading Partner
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight">
                Industrial solutions, delivered with precision.
            </h1>
            <p class="mt-6 text-lg lg:text-xl text-slate-200 leading-relaxed max-w-2xl">
                From construction chemicals to specialty exports, Cooper Trading supplies the products that build industries, support communities, and power growth across Ethiopia and East Africa.
            </p>
            <div class="mt-10 flex flex-wrap gap-4">
                <a href="{{ route('products') }}" class="inline-flex items-center px-6 py-3 rounded-md bg-white text-slate-900 font-medium hover:bg-slate-100 transition">
                    Browse Products
                </a>
                <a href="{{ route('quote.create') }}" class="inline-flex items-center px-6 py-3 rounded-md border border-white/30 text-white font-medium hover:bg-white/10 transition">
                    Request a Quote
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-20 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-3xl lg:text-4xl font-bold text-slate-900">Six markets. One trusted partner.</h2>
            <p class="mt-4 text-lg text-slate-600">
                We specialize in the supply of industrial, construction, and export products — combining deep category expertise with reliable sourcing and logistics.
            </p>
        </div>

        <div class="mt-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('products.category', $category) }}" class="group block bg-white rounded-xl border border-slate-200 overflow-hidden hover:border-slate-900 hover:shadow-lg transition">
                    <div class="aspect-[16/9] bg-slate-100 overflow-hidden">
                        <img src="{{ asset('assets/images/categories/' . $category->slug . '.jpg') }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center\'><span class=\'text-6xl font-bold text-white/30\'>{{ substr($category->name, 0, 1) }}</span></div>'">
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-slate-900">{{ $category->name }}</h3>
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

<section class="py-20 lg:py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div>
                <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wider">Why Cooper Trading</span>
                <h2 class="mt-3 text-3xl lg:text-4xl font-bold text-slate-900">Built for industrial buyers.</h2>
                <p class="mt-5 text-lg text-slate-600 leading-relaxed">
                    We work with contractors, manufacturers, project owners, and exporters to supply the right products at the right price — with consistent quality and on-time delivery.
                </p>
                <dl class="mt-10 space-y-6">
                    <div class="flex gap-4">
                        <div class="flex-none w-10 h-10 rounded-md bg-slate-900 text-white flex items-center justify-center font-bold">✓</div>
                        <div>
                            <dt class="font-semibold text-slate-900">Verified sourcing</dt>
                            <dd class="mt-1 text-sm text-slate-600">Every product is sourced from qualified manufacturers and inspected against international standards.</dd>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-none w-10 h-10 rounded-md bg-slate-900 text-white flex items-center justify-center font-bold">✓</div>
                        <div>
                            <dt class="font-semibold text-slate-900">Proforma invoices in 24 hours</dt>
                            <dd class="mt-1 text-sm text-slate-600">Send your quote request and receive a fully priced, VAT-compliant proforma invoice by email.</dd>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-none w-10 h-10 rounded-md bg-slate-900 text-white flex items-center justify-center font-bold">✓</div>
                        <div>
                            <dt class="font-semibold text-slate-900">Logistics & bulk handling</dt>
                            <dd class="mt-1 text-sm text-slate-600">From single pallets to multi-ton shipments, we coordinate packaging, transport, and documentation.</dd>
                        </div>
                    </div>
                </dl>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 p-10 lg:p-12 shadow-sm">
                <h3 class="text-2xl font-bold text-slate-900">Get a quote in minutes</h3>
                <p class="mt-3 text-slate-600">Tell us what you need — products, quantities, delivery location — and we'll send a proforma invoice to your inbox.</p>
                <ul class="mt-6 space-y-3 text-sm text-slate-600">
                    <li class="flex items-center gap-2"><span class="text-indigo-600">1.</span> Browse our catalog</li>
                    <li class="flex items-center gap-2"><span class="text-indigo-600">2.</span> Select products and quantities</li>
                    <li class="flex items-center gap-2"><span class="text-indigo-600">3.</span> Receive a proforma invoice by email</li>
                </ul>
                <a href="{{ route('quote.create') }}" class="mt-8 inline-flex items-center px-6 py-3 rounded-md bg-slate-900 text-white font-medium hover:bg-slate-800 transition">
                    Start a quote request
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-20 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-3xl lg:text-4xl font-bold text-slate-900">Industries we serve</h2>
            <p class="mt-4 text-lg text-slate-600">From infrastructure to FMCG, we supply the products that keep operations running.</p>
        </div>
        <div class="mt-12 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach (['Construction', 'Manufacturing', 'Water & Utilities', 'Packaging', 'Energy & Power', 'Export & Trade'] as $industry)
                <div class="text-center p-6 rounded-lg border border-slate-200">
                    <div class="text-base font-semibold text-slate-900">{{ $industry }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
