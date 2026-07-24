@extends('layouts.app')

@section('title', 'Contact Us')
@section('description', 'Get in touch with Cooper Trading. Send us a message and our team will respond as soon as possible.')

@section('content')
<section class="bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
        <div class="max-w-3xl">
            <span class="text-sm font-semibold text-indigo-400 uppercase tracking-wider">Contact</span>
            <h1 class="mt-3 text-4xl lg:text-5xl font-bold tracking-tight">Let's talk.</h1>
            <p class="mt-6 text-lg text-slate-300 leading-relaxed">
                Have a project, a tender, or a recurring supply need? Tell us about it and our team will respond within one business day.
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
                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider">Office</h3>
                    <p class="mt-2 text-slate-600">Addis Ababa, Ethiopia</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider">Email</h3>
                    <p class="mt-2"><a href="mailto:info@cooperatrading.com" class="text-slate-900 hover:underline">info@cooperatrading.com</a></p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider">Phone</h3>
                    <p class="mt-2"><a href="tel:+251111234567" class="text-slate-900 hover:underline">+251 11 123 4567</a></p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider">Hours</h3>
                    <p class="mt-2 text-slate-600">Mon–Fri: 8:30 – 18:00<br>Sat: 9:00 – 13:00</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
