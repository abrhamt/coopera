@extends('layouts.admin')

@section('title', 'Edit Product')

@section('header', 'Edit Product')
@section('subheader', $product->name)

@section('content')
<div class="max-w-3xl">
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('slug') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="unit_of_measure" class="block text-sm font-medium text-gray-700">Unit of Measure</label>
                <select name="unit_of_measure" id="unit_of_measure" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach (['piece', 'box', 'kg', 'ton', 'liter', 'meter'] as $uom)
                        <option value="{{ $uom }}" @selected(old('unit_of_measure', $product->unit_of_measure) === $uom)>{{ $uom }}</option>
                    @endforeach
                </select>
                @error('unit_of_measure') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                @if ($product->image)
                    <div class="mt-1 mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image. Max 2MB.</p>
                @error('image') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="5"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
                @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between gap-3 pt-4 border-t border-gray-200">
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 rounded-md text-sm text-red-700 hover:bg-red-50">Delete</button>
                </form>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100">Cancel</a>
                    <button type="submit" class="px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
