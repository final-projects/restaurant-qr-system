
@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 shadow rounded">
        <h2 class="text-xl font-semibold mb-4">Edit Category</h2>

        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Description</label>
                <textarea name="description" rows="3"
                          class="mt-1 block w-full rounded border-gray-300 shadow-sm">{{ old('description', $category->description) }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 mr-2 rounded bg-gray-200">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
