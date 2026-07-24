@extends('layouts.admin')

@section('title', 'New Category')

@section('header', 'New Category')
@section('subheader', 'Create a new product category')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug <span class="text-gray-400">(optional)</span></label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <p class="text-xs text-gray-500 mt-1">Auto-generated from name if left blank.</p>
                @error('slug') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100">Cancel</a>
                <button type="submit" class="px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">Create Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
