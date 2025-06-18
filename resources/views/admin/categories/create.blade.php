@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 shadow rounded">
        <h2 class="text-xl font-semibold mb-4">Add New Category</h2>

        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Name</label>
                <input type="text" name="name" required value="{{ old('name') }}"
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Description</label>
                <textarea name="description" rows="3" class="mt-1 block w-full rounded border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 mr-2 rounded bg-gray-200">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Create
                </button>
            </div>
        </form>
    </div>
@endsection
