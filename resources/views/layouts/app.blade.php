<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Cooper Trading') | Cooper Trading</title>
    <meta name="description" content="@yield('description', 'Cooper Trading — your trusted partner for construction, industrial chemicals, water solutions, packaging, technology, and export products.')">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased bg-white text-slate-800">

@php
    $navLinks = [
        ['route' => 'home', 'label' => 'Home'],
        ['route' => 'about', 'label' => 'About'],
        ['route' => 'products', 'label' => 'Products'],
        ['route' => 'contact', 'label' => 'Contact'],
    ];
@endphp

<header class="bg-white/95 backdrop-blur sticky top-0 z-40 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/brand/logo-mark.svg') }}" alt="Cooper Trading" class="h-10 w-auto">
                <span class="hidden sm:inline font-semibold text-lg text-slate-900">Cooper Trading</span>
            </a>

            <nav class="hidden md:flex items-center gap-1">
                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                        class="px-4 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs($link['route']) ? 'text-slate-900 bg-slate-100' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ route('quote.create') }}" class="hidden sm:inline-flex items-center px-4 py-2 rounded-md bg-slate-900 text-white text-sm font-medium hover:bg-slate-800 transition">
                    Request a Quote
                </a>
                <button type="button" x-data="" x-on:click="$dispatch('toggle-mobile-menu')" class="md:hidden p-2 rounded-md text-slate-600 hover:bg-slate-100" aria-label="Toggle menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-data="{ open: false }" x-on:toggle-mobile-menu.window="open = !open" x-show="open" x-transition x-cloak class="md:hidden border-t border-slate-200">
        <div class="px-4 py-3 space-y-1">
            @foreach ($navLinks as $link)
                <a href="{{ route($link['route']) }}" class="block px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs($link['route']) ? 'text-slate-900 bg-slate-100' : 'text-slate-600 hover:bg-slate-50' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <a href="{{ route('quote.create') }}" class="block px-3 py-2 rounded-md text-sm font-medium bg-slate-900 text-white">Request a Quote</a>
        </div>
    </div>
</header>

<main class="min-h-[60vh]">
    @yield('content')
</main>

<footer class="bg-slate-900 text-slate-300 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            <div class="md:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <img src="{{ asset('assets/brand/logo-mark-gradient.svg') }}" alt="Cooper Trading" class="h-10 w-auto">
                    <span class="font-semibold text-lg text-white">Cooper Trading</span>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Your trusted partner for industrial, construction, and export solutions across Ethiopia and beyond.
                </p>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Company</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-white">About Us</a></li>
                    <li><a href="{{ route('products') }}" class="hover:text-white">Products</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Solutions</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('products') }}" class="hover:text-white">Construction</a></li>
                    <li><a href="{{ route('products') }}" class="hover:text-white">Industrial Chemicals</a></li>
                    <li><a href="{{ route('products') }}" class="hover:text-white">Water Solutions</a></li>
                    <li><a href="{{ route('products') }}" class="hover:text-white">Export Products</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Contact</h3>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li>Addis Ababa, Ethiopia</li>
                    <li><a href="mailto:info@cooperatrading.com" class="hover:text-white">info@cooperatrading.com</a></li>
                    <li><a href="tel:+251111234567" class="hover:text-white">+251 11 123 4567</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-12 pt-8 border-t border-slate-800 text-sm text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p>&copy; {{ date('Y') }} Cooper Trading. All rights reserved.</p>
            <p>Built for industrial excellence.</p>
        </div>
    </div>
</footer>
</body>
</html>
