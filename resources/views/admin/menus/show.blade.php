@extends('layouts.admin')

@section('title', 'Menu Details')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Menu Item: {{ $menu->name }}</h2>
            <a href="{{ route('admin.menus.index') }}" class="text-sm text-gray-600 hover:text-gray-800 underline">
                ← Back to Menus
            </a>
        </div>

        {{-- Image --}}
        @if($menu->image)
            <div class="mb-6 text-center">
                <img src="{{ asset('storage/' . $menu->image) }}" alt="Menu Image"
                     class="w-40 h-40 object-cover rounded shadow mx-auto">
            </div>
        @endif

        {{-- Details --}}
        <div class="space-y-4 text-sm">
            <div>
                <span class="text-gray-500">Name:</span>
                <div class="text-gray-900 font-medium text-base">{{ $menu->name }}</div>
            </div>

            <div>
                <span class="text-gray-500">Description:</span>
                <div class="text-gray-700 mt-1">{{ $menu->description ?: '-' }}</div>
            </div>

            <div>
                <span class="text-gray-500">Category:</span>
                <div class="text-gray-800 font-medium mt-1">
                    {{ $menu->category ? $menu->category->name : 'Uncategorized' }}
                </div>
            </div>

            <div>
                <span class="text-gray-500">Price:</span>
                <div class="text-gray-800 font-medium mt-1">{{ $menu->formatted_price }}</div>
            </div>

            <div>
                <span class="text-gray-500">Status:</span>
                <span class="inline-block mt-1 px-2 py-1 rounded-full text-xs font-semibold
                    {{ $menu->available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $menu->available ? 'Available' : 'Not Available' }}
                </span>
            </div>

            <div>
                <span class="text-gray-500">Created At:</span>
                <div class="text-gray-700 mt-1">{{ $menu->created_at->format('Y-m-d H:i') }}</div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.menus.edit', $menu) }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm">
                Edit
            </a>

            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this menu item?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endsection
