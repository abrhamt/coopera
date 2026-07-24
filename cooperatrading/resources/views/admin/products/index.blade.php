@extends('layouts.admin')

@section('title', 'Products')

@section('header', 'Products')
@section('subheader', 'Manage your product catalog')

@section('actions')
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">
        + New Product
    </a>
@endsection

@section('content')
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-left text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-5 py-3">Product</th>
                    <th class="px-5 py-3">Category</th>
                    <th class="px-5 py-3">UoM</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($products as $product)
                    <tr>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-10 h-10 object-cover rounded">
                                @else
                                    <div class="w-10 h-10 rounded bg-gray-100 flex items-center justify-center text-gray-400 text-xs">img</div>
                                @endif
                                <div>
                                    <div class="font-medium text-gray-900">{{ $product->name }}</div>
                                    <div class="text-gray-500 text-xs font-mono">{{ $product->slug }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-gray-600">{{ $product->category->name }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $product->unit_of_measure }}</td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-800 text-sm">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block ml-3" onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-8 text-center text-gray-500">No products yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-gray-200">
        {{ $products->links() }}
    </div>
</div>
@endsection
