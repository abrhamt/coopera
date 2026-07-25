@extends('layouts.app')

@section('title', 'Request a Quote')
@section('description', 'Select products and quantities and receive a proforma invoice from Cooper Trading within 24 hours.')

@section('content')
@php
    $productsJson = $products->map(fn ($p) => [
        'id' => $p->id,
        'name' => $p->name,
        'category' => $p->category->name,
        'unit' => $p->unit_of_measure,
        'description' => $p->description,
        'image' => $p->image ? asset('storage/' . $p->image) : null,
    ])->values();
@endphp

<section class="bg-slate-900 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <span class="text-sm font-semibold text-indigo-400 uppercase tracking-wider">Request a Quote</span>
        <h1 class="mt-3 text-4xl lg:text-5xl font-bold tracking-tight">Tell us what you need.</h1>
        <p class="mt-4 text-lg text-slate-300 max-w-2xl">
            Select the products you're interested in, add quantities, and we'll send a complete proforma invoice — including VAT — to your email within 24 hours.
        </p>
    </div>
</section>

<section class="py-16 lg:py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <form action="{{ route('quote.store') }}" method="POST"
            x-data="quoteForm(@js($productsJson), @js($selectedIds))"
            x-cloak
            class="space-y-10">
            @csrf

            <div>
                <h2 class="text-lg font-semibold text-slate-900">Your contact information</h2>
                <p class="mt-1 text-sm text-slate-600">We'll send the proforma invoice to this email.</p>
                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-slate-700">Full name <span class="text-red-600">*</span></label>
                        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required
                            class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900">
                        @error('customer_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-slate-700">Company</label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}"
                            class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900">
                        @error('company_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">Email <span class="text-red-600">*</span></label>
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
                <div class="mt-5">
                    <label for="message" class="block text-sm font-medium text-slate-700">Additional notes</label>
                    <textarea name="message" id="message" rows="4"
                        class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-slate-900 focus:ring-slate-900"
                        placeholder="Delivery location, target dates, specifications, etc.">{{ old('message') }}</textarea>
                    @error('message') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Select products</h2>
                        <p class="mt-1 text-sm text-slate-600">Search the catalog and add quantities for each item.</p>
                    </div>
                    <div class="text-sm text-slate-500">
                        <span x-text="selectedItems.length"></span> selected
                    </div>
                </div>

                @error('items') <p class="mt-4 text-sm text-red-600">{{ $message }}</p> @enderror

                <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="border border-slate-200 rounded-xl overflow-hidden">
                        <div class="px-4 py-3 border-b border-slate-200 bg-slate-50">
                            <input type="text" x-model="search" placeholder="Search products by name or category..."
                                class="w-full rounded-md border-slate-300 text-sm focus:border-slate-900 focus:ring-slate-900">
                        </div>
                        <div class="max-h-96 overflow-y-auto divide-y divide-slate-100">
                            <template x-for="product in filteredProducts()" :key="product.id">
                                <button type="button" x-on:click="toggle(product)"
                                    class="w-full text-left px-4 py-3 hover:bg-slate-50 flex items-center justify-between gap-4"
                                    :class="isSelected(product.id) ? 'bg-slate-50' : ''">
                                    <div class="flex-1">
                                        <div class="font-medium text-slate-900 text-sm" x-text="product.name"></div>
                                        <div class="text-xs text-slate-500" x-text="product.category + ' · per ' + product.unit"></div>
                                    </div>
                                    <div class="text-xs font-medium"
                                        :class="isSelected(product.id) ? 'text-slate-900' : 'text-slate-400'"
                                        x-text="isSelected(product.id) ? '✓ Selected' : 'Add'"></div>
                                </button>
                            </template>
                            <div x-show="filteredProducts().length === 0" class="px-4 py-6 text-sm text-slate-500 text-center">
                                No products match your search.
                            </div>
                        </div>
                    </div>

                    <div class="border border-slate-200 rounded-xl">
                        <div class="px-4 py-3 border-b border-slate-200 bg-slate-50">
                            <h3 class="text-sm font-semibold text-slate-900">Your selection</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto p-4 space-y-3">
                            <template x-for="item in selectedItems" :key="item.product.id">
                                <div class="flex items-center gap-3 p-3 border border-slate-200 rounded-lg">
                                    <div class="flex-1 min-w-0">
                                        <div class="font-medium text-slate-900 text-sm truncate" x-text="item.product.name"></div>
                                        <div class="text-xs text-slate-500" x-text="item.product.category"></div>
                                    </div>
                                    <div class="flex-none">
                                        <label class="text-xs text-slate-500 block">Quantity</label>
                                        <input type="number" min="1" step="1" x-model.number="item.quantity"
                                            class="w-24 rounded-md border-slate-300 text-sm focus:border-slate-900 focus:ring-slate-900">
                                    </div>
                                    <div class="flex-none">
                                        <span class="text-xs text-slate-500 block">Unit</span>
                                        <span class="text-sm font-medium text-slate-900" x-text="item.product.unit"></span>
                                    </div>
                                    <button type="button" x-on:click="toggle(item.product)" class="flex-none text-slate-400 hover:text-red-600" aria-label="Remove">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </template>
                            <div x-show="selectedItems.length === 0" class="text-sm text-slate-500 text-center py-8">
                                Click products on the left to add them.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200 flex items-center justify-between">
                <p class="text-sm text-slate-500">By submitting, you agree to receive a proforma invoice by email.</p>
                <button type="submit" class="inline-flex items-center px-6 py-3 rounded-md bg-slate-900 text-white font-medium hover:bg-slate-800 transition disabled:opacity-50"
                    :disabled="selectedItems.length === 0">
                    Submit quote request
                </button>
            </div>

            <template x-for="(item, index) in selectedItems" :key="item.product.id">
                <div>
                    <input type="hidden" :name="`items[${index}][product_id]`" :value="item.product.id">
                    <input type="hidden" :name="`items[${index}][quantity]`" :value="item.quantity">
                </div>
            </template>
        </form>
    </div>
</section>
@endsection

<script>
function quoteForm(products, selectedIds) {
    return {
        products: products,
        search: '',
        selectedItems: products
            .filter(p => selectedIds.includes(p.id))
            .map(p => ({ product: p, quantity: 1 })),

        filteredProducts() {
            const q = this.search.toLowerCase().trim();
            if (!q) return this.products;
            return this.products.filter(p =>
                p.name.toLowerCase().includes(q) ||
                p.category.toLowerCase().includes(q)
            );
        },

        isSelected(id) {
            return this.selectedItems.some(item => item.product.id === id);
        },

        toggle(product) {
            const idx = this.selectedItems.findIndex(item => item.product.id === product.id);
            if (idx >= 0) {
                this.selectedItems.splice(idx, 1);
            } else {
                this.selectedItems.push({ product: product, quantity: 1 });
            }
        },
    };
}
</script>
