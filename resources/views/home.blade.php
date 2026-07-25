@extends('layouts.app')

@section('title', 'Home')
@section('description', 'Cooper Trading — your trusted partner for construction, industrial chemicals, water solutions, packaging, technology, and export products across Ethiopia and beyond.')

@section('content')
<section class="relative isolate overflow-hidden bg-slate-950 text-white">
    <div class="absolute inset-0">
        <img src="{{ asset('assets/images/hero.jpg') }}" alt="" class="h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/85 to-slate-950/35"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-slate-950/20"></div>
    </div>
    <div class="relative mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-32">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.2em] text-amber-300">
                <span class="h-px w-8 bg-amber-300"></span>
                Import · Export · Industrial Supply
            </div>
            <h1 class="mt-6 max-w-3xl text-5xl font-semibold leading-[1.05] tracking-tight sm:text-6xl lg:text-7xl">
                Trade that moves Ethiopia forward.
            </h1>
            <p class="mt-7 max-w-2xl text-lg leading-relaxed text-slate-200 sm:text-xl">
                We source and supply the products, materials, and industrial solutions that help businesses build, operate, and grow with confidence.
            </p>
            <div class="mt-10 flex flex-wrap gap-4">
                <a href="{{ route('products') }}" class="inline-flex items-center justify-center rounded-md bg-amber-400 px-6 py-3.5 font-semibold text-slate-950 transition hover:bg-amber-300">
                    Explore our markets
                    <span class="ml-3 text-lg">→</span>
                </a>
                <a href="{{ route('quote.create') }}" class="inline-flex items-center justify-center rounded-md border border-white/30 px-6 py-3.5 font-semibold text-white transition hover:border-white hover:bg-white/10">
                    Request a quote
                </a>
            </div>
        </div>
    </div>
</section>

<section class="border-b border-slate-200 bg-white">
    <div class="mx-auto grid max-w-7xl grid-cols-2 divide-x divide-slate-200 px-4 sm:px-6 md:grid-cols-4 lg:px-8">
        <div class="px-4 py-7 text-center sm:px-8 md:text-left">
            <div class="text-2xl font-semibold text-slate-950">6</div>
            <div class="mt-1 text-sm text-slate-500">Specialized markets</div>
        </div>
        <div class="px-4 py-7 text-center sm:px-8 md:text-left">
            <div class="text-2xl font-semibold text-slate-950">24h</div>
            <div class="mt-1 text-sm text-slate-500">Quote response target</div>
        </div>
        <div class="border-t border-slate-200 px-4 py-7 text-center sm:px-8 md:border-t-0 md:text-left">
            <div class="text-2xl font-semibold text-slate-950">B2B</div>
            <div class="mt-1 text-sm text-slate-500">Sourcing and supply</div>
        </div>
        <div class="border-t border-slate-200 px-4 py-7 text-center sm:px-8 md:border-t-0 md:text-left">
            <div class="text-2xl font-semibold text-slate-950">Ethiopia</div>
            <div class="mt-1 text-sm text-slate-500">Local knowledge, broad reach</div>
        </div>
    </div>
</section>

<section class="bg-[#f7f5f0] py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
            <div class="max-w-2xl">
                <div class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-700">What we do</div>
                <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">One partner for the markets that matter.</h2>
            </div>
            <p class="max-w-md text-base leading-relaxed text-slate-600">From industrial inputs to export products, we connect reliable supply with the businesses shaping Ethiopia's future.</p>
        </div>

        <div class="mt-12 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($categories as $category)
                <a href="{{ route('products.category', $category) }}" class="group relative isolate min-h-[280px] overflow-hidden rounded-lg bg-slate-900 text-white">
                    <img src="{{ asset('assets/images/categories/' . $category->slug . '.jpg') }}" alt="{{ $category->name }}" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105" onerror="this.style.display='none'">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/45 to-transparent"></div>
                    <div class="relative flex h-full min-h-[280px] flex-col justify-end p-6">
                        <div class="mb-3 h-px w-10 bg-amber-400 transition-all duration-300 group-hover:w-16"></div>
                        <h3 class="text-xl font-semibold">{{ $category->name }}</h3>
                        <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-slate-200">{{ $category->description }}</p>
                        <span class="mt-5 text-sm font-semibold text-amber-300">View market <span class="ml-1 transition group-hover:ml-2">→</span></span>
                    </div>
                </a>
            @empty
                <div class="rounded-lg border border-slate-200 bg-white p-8 text-slate-600 sm:col-span-2 lg:col-span-3">Our market categories will appear here shortly.</div>
            @endforelse
        </div>
    </div>
</section>

<section class="bg-white py-20 lg:py-28">
    <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-2 lg:gap-20 lg:px-8">
        <div class="relative overflow-hidden rounded-lg bg-slate-950">
            <img src="{{ asset('assets/images/hero.jpg') }}" alt="Cooper Trading industrial supply" class="aspect-[4/5] w-full object-cover opacity-80">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-8 sm:p-10">
                <div class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-300">Why Cooper Trading</div>
                <p class="mt-3 max-w-xs text-2xl font-semibold leading-tight text-white">Built around dependable supply and long-term partnerships.</p>
            </div>
        </div>
        <div>
            <div class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-700">A partner you can build on</div>
            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">Practical expertise. Reliable delivery.</h2>
            <p class="mt-6 text-lg leading-relaxed text-slate-600">We work with contractors, manufacturers, project owners, and exporters to source the right products at the right price, with consistent quality and responsive service.</p>
            <div class="mt-9 space-y-6">
                <div class="flex gap-4">
                    <div class="flex h-9 w-9 flex-none items-center justify-center rounded-full bg-amber-100 font-semibold text-amber-800">01</div>
                    <div>
                        <h3 class="font-semibold text-slate-950">Qualified sourcing</h3>
                        <p class="mt-1 text-sm leading-relaxed text-slate-600">We connect you with dependable manufacturers and products selected for real operating needs.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex h-9 w-9 flex-none items-center justify-center rounded-full bg-amber-100 font-semibold text-amber-800">02</div>
                    <div>
                        <h3 class="font-semibold text-slate-950">Clear commercial support</h3>
                        <p class="mt-1 text-sm leading-relaxed text-slate-600">Get clear product information, quantities, pricing, and proforma support from one team.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex h-9 w-9 flex-none items-center justify-center rounded-full bg-amber-100 font-semibold text-amber-800">03</div>
                    <div>
                        <h3 class="font-semibold text-slate-950">Logistics that keep moving</h3>
                        <p class="mt-1 text-sm leading-relaxed text-slate-600">From single pallets to bulk shipments, we coordinate the details that keep projects on schedule.</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('about') }}" class="mt-10 inline-flex items-center font-semibold text-slate-950 transition hover:text-amber-700">Learn more about us <span class="ml-2 text-lg">→</span></a>
        </div>
    </div>
</section>

<section class="border-y border-slate-200 bg-slate-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <div class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-700">Who we serve</div>
                <h2 class="mt-3 text-2xl font-semibold text-slate-950">Supply for the work behind growth.</h2>
            </div>
            <div class="grid grid-cols-2 gap-x-8 gap-y-4 text-sm font-medium text-slate-700 sm:grid-cols-3 lg:grid-cols-6">
                @foreach (['Construction', 'Manufacturing', 'Water & Utilities', 'Packaging', 'Energy & Power', 'Export & Trade'] as $industry)
                    <div class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>{{ $industry }}</div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="bg-amber-400">
    <div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 py-16 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8 lg:py-20">
        <div class="max-w-2xl">
            <div class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-950/70">Ready to source?</div>
            <h2 class="mt-3 text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">Tell us what your business needs next.</h2>
            <p class="mt-4 max-w-xl text-base leading-relaxed text-amber-950/80">Share your products, quantities, and delivery requirements. Our team will help you move from request to supply.</p>
        </div>
        <a href="{{ route('quote.create') }}" class="inline-flex flex-none items-center justify-center rounded-md bg-slate-950 px-6 py-3.5 font-semibold text-white transition hover:bg-slate-800">Start a quote request <span class="ml-3 text-lg">→</span></a>
    </div>
</section>
@endsection
