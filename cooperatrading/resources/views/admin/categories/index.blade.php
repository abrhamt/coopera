@extends('layouts.admin')

@section('title', 'Categories')

@section('header', 'Categories')
@section('subheader', 'Organize products into categories')

@section('actions')
    <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700">
        + New Category
    </a>
@endsection

@section('content')
<div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-left text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-5 py-3">Name</th>
                    <th class="px-5 py-3">Slug</th>
                    <th class="px-5 py-3">Products</th>
                    <th class="px-5 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($categories as $category)
                    <tr>
                        <td class="px-5 py-3">
                            <div class="font-medium text-gray-900">{{ $category->name }}</div>
                            @if ($category->description)
                                <div class="text-gray-500 text-xs mt-0.5 line-clamp-1">{{ $category->description }}</div>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-gray-600 font-mono text-xs">{{ $category->slug }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $category->products_count }}</td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-800 text-sm">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block ml-3" onsubmit="return confirm('Delete this category? Products will also be deleted.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-8 text-center text-gray-500">No categories yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-gray-200">
        {{ $categories->links() }}
    </div>
</div>
@endsection
