@extends('layouts.admin')

@section('title', 'Edit Menu Item')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Edit Menu Item</h2>
            <a href="{{ route('admin.menus.index') }}" class="text-sm text-gray-600 hover:text-gray-800 underline">
                ← Back to Menus
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $menu->name) }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-medium mb-1">Description</label>
                <textarea id="description" name="description" rows="3"
                          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $menu->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-gray-700 font-medium mb-1">Price (EGP)</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price', $menu->price) }}"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="category_id" class="block text-gray-700 font-medium mb-1">Category</label>
                    <select name="category_id" id="category_id"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="image" class="block text-gray-700 font-medium mb-1">Image</label>
                <input type="file" name="image" id="image"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @if($menu->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="Menu Image" class="w-24 h-24 object-cover rounded shadow">
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="available" name="available" value="1" {{ old('available', $menu->available) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <label for="available" class="text-sm text-gray-700">Available</label>
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow-sm transition">
                    Update Menu
                </button>
            </div>
        </form>
    </div>
@endsection
