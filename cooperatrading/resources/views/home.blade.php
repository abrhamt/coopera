@extends('layouts.app')

@section('title', 'Home')
@section('description', 'Coopera Trading — your trusted partner for construction chemicals, industrial raw materials, specialty exports, and global logistics across Ethiopia and East Africa.')

@section('content')
    <section x-data="{
            activeSlide: 0,
            autoplay: null,
            slides: [
                {
                    badge: 'Construction Product Markets',
                    title: 'Construction chemicals & high-performance systems.',
                    description: 'Comprehensive range of concrete admixtures, waterproofing membranes, structural epoxies, and grouting solutions built for infrastructure scale.',
                    bgImage: '{{ asset('assets/images/hero/slide-construction.jpg') }}',
                    tags: ['Concrete Admixtures', 'Waterproofing', 'Structural Epoxies', 'Grouting'],
                    proforma: 'Sent within 24 Hours',
                    categorySlug: 'construction-product-markets'
                },
                {
                    badge: 'Specialty Ethiopian Exports',
                    title: 'Direct Ethiopian exports to global markets.',
                    description: 'Premium Arabica coffee, natural sesame seeds, pulses, and Ethiopian spices — sourced with 100% quality and origin traceability.',
                    bgImage: '{{ asset('assets/images/hero/slide-export.jpg') }}',
                    tags: ['Arabica Coffee', 'Sesame Seeds', 'Pulses & Beans', 'Spices'],
                    proforma: 'Export Proforma Ready',
                    categorySlug: 'export-products'
                },
                {
                    badge: 'Industrial Chemicals & Materials',
                    title: 'Raw materials & chemicals for manufacturing.',
                    description: 'Industrial grade chemicals, polymer resins, plastic additives, and processing solvents tailored for high-volume production.',
                    bgImage: '{{ asset('assets/images/hero/slide-chemical.jpg') }}',
                    tags: ['Polymer Resins', 'Plastic Additives', 'Industrial Solvents', 'Raw Materials'],
                    proforma: 'Bulk Pricing Available',
                    categorySlug: 'industrial-chemicals-plastic-raw-materials'
                },
                {
                    badge: 'Bulk Global Logistics & Supply Chain',
                    title: 'Integrated logistics & global sourcing precision.',
                    description: 'End-to-end supply chain management, customs clearance support, bulk cargo handling, and freight logistics across East Africa.',
                    bgImage: '{{ asset('assets/images/hero/slide-logistics.jpg') }}',
                    tags: ['Freight Logistics', 'Customs Clearance', 'Bulk Cargo', 'Warehousing'],
                    proforma: 'Full Freight Quotes',
                    categorySlug: 'water-environmental-solutions'
                }
            ],
            init() {
                this.startAutoplay();
            },
            startAutoplay() {
                this.autoplay = setInterval(() => {
                    this.nextSlide();
                }, 6000);
            },
            stopAutoplay() {
                if (this.autoplay) clearInterval(this.autoplay);
            },
            nextSlide() {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            },
            prevSlide() {
                this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
            }
        }" x-on:mouseenter="stopAutoplay()" x-on:mouseleave="startAutoplay()"
        class="relative bg-slate-950 text-white min-h-[720px] lg:min-h-[800px] flex items-center overflow-hidden pt-20 lg:pt-24">

        <!-- 1. Background Image Slider Layer (z-0) -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95" class="absolute inset-0">
                    <img :src="slide.bgImage" :alt="slide.badge" class="w-full h-full object-cover">
                </div>
            </template>
        </div>

        <!-- 2. Dark Gradient Overlay Layers (z-10) -->
        <div
            class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-900/80 to-slate-900/50 z-10 pointer-events-none">
        </div>
        <div class="absolute inset-0 bg-slate-950/30 z-10 pointer-events-none"></div>

        <!-- 3. Animated Particle Canvas Layer (z-20) -->
        <canvas id="heroCanvas" class="absolute inset-0 w-full h-full opacity-35 pointer-events-none z-20"></canvas>

        <!-- 4. Split 2-Column Hero Content Container (z-30) -->
        <div class="relative z-30 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 w-full pointer-events-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

                <!-- Left Column: Pillar Title & Carousel Navigation (col-span-7) -->
                <div class="lg:col-span-7 space-y-6">
                    <!-- Category Badge Pill -->
                    <div
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-900/60 border border-indigo-500/40 text-indigo-300 text-xs font-bold uppercase tracking-wider backdrop-blur-sm shadow-md">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        <span x-text="slides[activeSlide].badge"></span>
                    </div>

                    <!-- Headline Typography -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.1] text-white [text-shadow:_0_4px_24px_rgba(0,0,0,0.9)] min-h-[120px] sm:min-h-[140px]"
                        x-text="slides[activeSlide].title">
                    </h1>

                    <!-- Subtitle Description -->
                    <p class="text-base sm:text-lg text-slate-200/90 font-normal leading-relaxed max-w-xl [text-shadow:_0_2px_12px_rgba(0,0,0,0.85)] min-h-[75px]"
                        x-text="slides[activeSlide].description">
                    </p>

                    <!-- Slide Navigation Dots, Controls & Counter -->
                    <div class="flex items-center gap-6 pt-2">
                        <div class="flex gap-2">
                            <template x-for="(slide, index) in slides" :key="index">
                                <button x-on:click="activeSlide = index"
                                    class="h-2 rounded-full transition-all duration-500 cursor-pointer"
                                    :class="activeSlide === index ? 'w-8 bg-indigo-400 shadow-md shadow-indigo-500/50' : 'w-2.5 bg-white/40 hover:bg-white/70'"
                                    :aria-label="'Go to slide ' + (index + 1)"></button>
                            </template>
                        </div>

                        <span class="text-xs text-slate-300 font-mono tracking-widest">
                            0<span x-text="activeSlide + 1"></span> / 04
                        </span>

                        <div class="flex items-center gap-1.5 ml-2">
                            <button x-on:click="prevSlide()"
                                class="p-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white transition cursor-pointer"
                                aria-label="Previous slide">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button x-on:click="nextSlide()"
                                class="p-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white transition cursor-pointer"
                                aria-label="Next slide">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Dynamic Interactive Glass Card Widget (col-span-5) -->

            </div>
        </div>
    </section>

    <!-- Particle Canvas Animation -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const canvas = document.getElementById('heroCanvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width = canvas.width = canvas.offsetWidth;
            let height = canvas.height = canvas.offsetHeight;

            window.addEventListener('resize', () => {
                width = canvas.width = canvas.offsetWidth;
                height = canvas.height = canvas.offsetHeight;
            });

            const particles = [];
            const count = 45;

            for (let i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    vx: (Math.random() - 0.5) * 0.4,
                    vy: (Math.random() - 0.5) * 0.4,
                    radius: Math.random() * 2 + 1,
                    alpha: Math.random() * 0.5 + 0.2
                });
            }

            function animate() {
                ctx.clearRect(0, 0, width, height);

                for (let i = 0; i < particles.length; i++) {
                    for (let j = i + 1; j < particles.length; j++) {
                        const dx = particles[i].x - particles[j].x;
                        const dy = particles[i].y - particles[j].y;
                        const dist = Math.sqrt(dx * dx + dy * dy);

                        if (dist < 120) {
                            ctx.beginPath();
                            ctx.moveTo(particles[i].x, particles[i].y);
                            ctx.lineTo(particles[j].x, particles[j].y);
                            ctx.strokeStyle = `rgba(255, 255, 255, ${0.15 * (1 - dist / 120)})`;
                            ctx.lineWidth = 0.8;
                            ctx.stroke();
                        }
                    }
                }

                particles.forEach(p => {
                    p.x += p.vx;
                    p.y += p.vy;

                    if (p.x < 0 || p.x > width) p.vx *= -1;
                    if (p.y < 0 || p.y > height) p.vy *= -1;

                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(255, 255, 255, ${p.alpha})`;
                    ctx.fill();
                });

                requestAnimationFrame(animate);
            }

            animate();
        });
    </script>

    <!-- Product Categories: Split into Import & Export Sections -->
    <section class="py-20 lg:py-24 bg-white rounded-t-[40px] -mt-10 relative z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- SECTION 1: IMPORT CATEGORIES -->
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-wider mb-3">
                    🚢 Industrial Import Supply Lines
                </span>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-900">Industrial & Construction Imports</h2>
                <p class="mt-3 text-lg text-slate-600">
                    High-performance construction chemicals, raw materials, water treatment equipment, and industrial packaging imported for Ethiopian projects.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center max-w-6xl mx-auto">
                @foreach ($categories->reject(fn($c) => $c->slug === 'export-products') as $category)
                    <a href="{{ route('products.category', $category) }}"
                        class="group flex flex-col items-center text-center bg-white rounded-2xl border border-slate-200 overflow-hidden hover:border-indigo-600 hover:shadow-xl transition-all duration-300 h-full">
                        <div class="h-48 sm:h-52 w-full bg-slate-100 overflow-hidden shrink-0">
                            <img src="{{ asset('assets/images/categories/' . $category->slug . '.jpg') }}"
                                alt="{{ $category->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center\'><span class=\'text-6xl font-bold text-white/30\'>{{ substr($category->name, 0, 1) }}</span></div>'">
                        </div>
                        <div class="p-6 flex flex-col items-center justify-between flex-1 w-full">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition">{{ $category->name }}</h3>
                                <p class="mt-2 text-sm text-slate-600 line-clamp-2">{{ $category->description }}</p>
                            </div>
                            <span class="mt-5 inline-flex items-center gap-1 text-sm font-bold text-indigo-600 group-hover:gap-2 transition-all">
                                View Products <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- SECTION 2: EXPORT CATEGORIES -->
            @if($exportCat = $categories->firstWhere('slug', 'export-products'))
                <div class="mt-24 pt-16 border-t border-slate-200">
                    <div class="text-center max-w-3xl mx-auto mb-12">
                        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-bold uppercase tracking-wider mb-3">
                            🌍 Specialty Ethiopian Exports
                        </span>
                        <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-900">Certified Export Products</h2>
                        <p class="mt-3 text-lg text-slate-600">
                            Premium Ethiopian-origin agricultural and natural commodities processed and exported to global markets with 100% quality traceability.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center max-w-6xl mx-auto">
                        <div class="md:col-span-2 lg:col-span-1 lg:col-start-2 w-full">
                            <a href="{{ route('products.category', $exportCat) }}"
                                class="group flex flex-col items-center text-center bg-white rounded-2xl border-2 border-amber-500/30 overflow-hidden hover:border-amber-500 hover:shadow-2xl transition-all duration-300 h-full">
                                <div class="h-48 sm:h-52 w-full bg-slate-100 overflow-hidden shrink-0">
                                    <img src="{{ asset('assets/images/categories/' . $exportCat->slug . '.jpg') }}"
                                        alt="{{ $exportCat->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                </div>
                                <div class="p-6 flex flex-col items-center justify-between flex-1 w-full">
                                    <div>
                                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-amber-700 transition">{{ $exportCat->name }}</h3>
                                        <p class="mt-2 text-sm text-slate-600 line-clamp-2">{{ $exportCat->description }}</p>
                                    </div>
                                    <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-amber-700 group-hover:gap-2 transition-all">
                                        Explore Export Products <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>

    <section class="py-20 lg:py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div>
                    <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wider">Why Coopera Trading</span>
                    <h2 class="mt-3 text-3xl lg:text-4xl font-bold text-slate-900">Built for industrial buyers.</h2>
                    <p class="mt-5 text-lg text-slate-600 leading-relaxed">
                        We work with contractors, manufacturers, project owners, and exporters to supply the right products
                        at the right price — with consistent quality and on-time delivery.
                    </p>
                    <dl class="mt-10 space-y-6">
                        <div class="flex gap-4">
                            <div
                                class="flex-none w-10 h-10 rounded-md bg-slate-900 text-white flex items-center justify-center font-bold">
                                ✓</div>
                            <div>
                                <dt class="font-semibold text-slate-900">Verified sourcing</dt>
                                <dd class="mt-1 text-sm text-slate-600">Every product is sourced from qualified
                                    manufacturers and inspected against international standards.</dd>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="flex-none w-10 h-10 rounded-md bg-slate-900 text-white flex items-center justify-center font-bold">
                                ✓</div>
                            <div>
                                <dt class="font-semibold text-slate-900">Proforma invoices in 24 hours</dt>
                                <dd class="mt-1 text-sm text-slate-600">Send your quote request and receive a fully priced,
                                    VAT-compliant proforma invoice by email.</dd>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="flex-none w-10 h-10 rounded-md bg-slate-900 text-white flex items-center justify-center font-bold">
                                ✓</div>
                            <div>
                                <dt class="font-semibold text-slate-900">Logistics & bulk handling</dt>
                                <dd class="mt-1 text-sm text-slate-600">From single pallets to multi-ton shipments, we
                                    coordinate packaging, transport, and documentation.</dd>
                            </div>
                        </div>
                    </dl>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 p-10 lg:p-12 shadow-sm">
                    <h3 class="text-2xl font-bold text-slate-900">Get a quote in minutes</h3>
                    <p class="mt-3 text-slate-600">Tell us what you need — products, quantities, delivery location — and
                        we'll send a proforma invoice to your inbox.</p>
                    <ul class="mt-6 space-y-3 text-sm text-slate-600">
                        <li class="flex items-center gap-2"><span class="text-indigo-600">1.</span> Browse our catalog</li>
                        <li class="flex items-center gap-2"><span class="text-indigo-600">2.</span> Select products and
                            quantities</li>
                        <li class="flex items-center gap-2"><span class="text-indigo-600">3.</span> Receive a proforma
                            invoice by email</li>
                    </ul>
                    <a href="{{ route('quote.create') }}"
                        class="mt-8 inline-flex items-center px-6 py-3 rounded-md bg-slate-900 text-white font-medium hover:bg-slate-800 transition">
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
                <p class="mt-4 text-lg text-slate-600">From infrastructure to FMCG, we supply the products that keep
                    operations running.</p>
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