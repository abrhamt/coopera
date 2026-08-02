@extends('layouts.app')

@section('title', 'Contact Us')
@section('description', 'Get in touch with Coopera Trading. Send us a message and our team will respond as soon as possible.')

@section('content')
<section class="relative bg-slate-950 text-white min-h-[380px] lg:min-h-[420px] flex items-center overflow-hidden">
    <!-- Banner Image Background Layer -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="{{ asset('assets/images/hero/contact-bg.jpg') }}" alt="Contact Coopera Trading" class="w-full h-full object-cover transform scale-105 opacity-60">
    </div>

    <!-- Dual-Tone Dark Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-900/90 to-indigo-950/80 z-10 pointer-events-none"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/90 via-slate-900/70 to-slate-950 z-10 pointer-events-none"></div>

    <!-- Content Container -->
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 w-full">
        <div class="max-w-3xl space-y-4">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-white/10 text-emerald-400 border border-white/20 backdrop-blur-md shadow-lg shadow-black/20 uppercase tracking-wider">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                Contact & Trade Inquiries
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight text-white [text-shadow:_0_4px_24px_rgba(0,0,0,0.9)]">
                Let's talk.
            </h1>
            <p class="text-lg lg:text-xl text-slate-200 leading-relaxed max-w-2xl [text-shadow:_0_2px_12px_rgba(0,0,0,0.85)]">
                Have a project, a tender, or a recurring supply need? Tell us about it and our specialist team will respond within one business day.
            </p>
        </div>
    </div>
</section>

<section class="py-20 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-bold text-slate-900">Send us a message</h2>
                <p class="mt-2 text-slate-600">For product inquiries, request a quote instead.</p>

                @if (session('contact_status'))
                    <div class="mt-6 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                        {{ session('contact_status') }}
                    </div>
                @endif

                @if ($errors->any() && !session('contact_status'))
                    <div class="mt-6 rounded-md bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">
                        Please correct the errors below and try again.
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="mt-8 space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700">Full name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900">
                            @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="company" class="block text-sm font-medium text-slate-700">Company</label>
                            <input type="text" name="company" id="company" value="{{ old('company') }}"
                                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900">
                            @error('company') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900">
                            @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700">Phone</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900">
                            @error('phone') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-slate-700">Message</label>
                        <textarea name="message" id="message" rows="5" required
                            class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900">{{ old('message') }}</textarea>
                        @error('message') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="inline-flex items-center px-6 py-3 rounded-md bg-slate-900 text-white font-medium hover:bg-slate-800 transition">
                        Send message
                    </button>
                </form>
            </div>
            <div class="space-y-8">
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider">Office Address</h3>
                    <p class="mt-2 text-slate-600">Bole Road, Addis Ababa, Ethiopia</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider">Email</h3>
                    <p class="mt-2"><a href="mailto:info@cooperatrading.com" class="text-indigo-600 font-semibold hover:underline">info@cooperatrading.com</a></p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider">Phone & WhatsApp</h3>
                    <div class="mt-2 space-y-1.5 text-sm">
                        <p>
                            <a href="https://wa.me/12012320125" target="_blank" class="inline-flex items-center gap-1.5 text-emerald-600 font-bold hover:underline">
                                💬 +1 201 232 0125 <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full">WhatsApp</span>
                            </a>
                        </p>
                        <p>
                            <a href="tel:+251973397012" class="text-slate-900 font-semibold hover:underline">
                                📞 +251 97 339 7012
                            </a>
                        </p>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider">Business Hours</h3>
                    <p class="mt-2 text-slate-600">Mon–Fri: 8:30 – 18:00<br>Sat: 9:00 – 13:00</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="max-w-3xl">
            <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wider">Find us</span>
            <h2 class="mt-3 text-2xl lg:text-3xl font-bold tracking-tight text-slate-900">Visit our office</h2>
            <p class="mt-3 text-slate-600">Stop by our headquarters in Addis Ababa. We are happy to meet in person to discuss your project.</p>
        </div>
        <div class="mt-8 rounded-lg overflow-hidden border border-slate-200 shadow-sm bg-white">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14083.823984724197!2d38.77901526787768!3d8.993393721377963!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b85005161ac83%3A0x6ce7fbec7937ba84!2sCoopera%20Trading!5e0!3m2!1sen!2set!4v1785138716825!5m2!1sen!2set" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </div>
    </div>
</section>
@endsection
