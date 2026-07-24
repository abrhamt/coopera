@extends('layouts.app')

@section('title', 'About Us')
@section('description', 'Learn about Cooper Trading — our mission, our markets, and our commitment to delivering industrial and export products across Ethiopia and East Africa.')

@section('content')
<section class="bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
        <div class="max-w-3xl">
            <span class="text-sm font-semibold text-indigo-400 uppercase tracking-wider">About Cooper Trading</span>
            <h1 class="mt-3 text-4xl lg:text-5xl font-bold tracking-tight">Trading that builds industries.</h1>
            <p class="mt-6 text-lg text-slate-300 leading-relaxed">
                Cooper Trading is a B2B trading company supplying construction, industrial, water, packaging, technology, and export products across Ethiopia and the wider region. We connect manufacturers and buyers with the products, documentation, and logistics they need to grow.
            </p>
        </div>
    </div>
</section>

<section class="py-20 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
            <div>
                <h2 class="text-3xl font-bold text-slate-900">Our mission</h2>
                <p class="mt-5 text-slate-600 leading-relaxed">
                    To be the most reliable supply partner for industrial and construction buyers in Ethiopia — delivering the right product, at the right price, on time, with the documentation needed to keep projects moving.
                </p>
                <h2 class="mt-12 text-3xl font-bold text-slate-900">What we do</h2>
                <p class="mt-5 text-slate-600 leading-relaxed">
                    We source, supply, and deliver specialty products across six markets. Our team manages supplier qualification, product specification, pricing, proforma invoicing, and logistics — so our customers can focus on their own operations.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="bg-slate-50 rounded-xl p-6">
                    <div class="text-4xl font-bold text-slate-900">6</div>
                    <div class="mt-1 text-sm text-slate-600">Core markets served</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-6">
                    <div class="text-4xl font-bold text-slate-900">35+</div>
                    <div class="mt-1 text-sm text-slate-600">Product categories</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-6">
                    <div class="text-4xl font-bold text-slate-900">24h</div>
                    <div class="mt-1 text-sm text-slate-600">Proforma response time</div>
                </div>
                <div class="bg-slate-50 rounded-xl p-6">
                    <div class="text-4xl font-bold text-slate-900">15%</div>
                    <div class="mt-1 text-sm text-slate-600">VAT-compliant invoicing</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 lg:py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-3xl lg:text-4xl font-bold text-slate-900">Our values</h2>
            <p class="mt-4 text-lg text-slate-600">The principles that guide every transaction.</p>
        </div>
        <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ([
                ['Reliability', 'We deliver on our commitments. Every shipment, every invoice, every timeline.'],
                ['Transparency', 'Clear pricing, clear documentation, and clear communication throughout every transaction.'],
                ['Quality', 'Every product is sourced from qualified manufacturers and meets applicable standards.']
            ] as [$title, $body])
                <div class="bg-white border border-slate-200 rounded-xl p-8">
                    <h3 class="text-xl font-semibold text-slate-900">{{ $title }}</h3>
                    <p class="mt-3 text-slate-600 leading-relaxed">{{ $body }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
