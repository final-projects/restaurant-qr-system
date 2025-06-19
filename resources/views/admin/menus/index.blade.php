@extends('layouts.admin')

@section('title', 'Manage Menus')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">All Menu Items</h2>
        <a href="{{ route('admin.menus.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            + Add New Item
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5">
        @forelse($menus as $menu)
            <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-md transition">
                @if($menu->image)
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                         class="h-32 w-full object-cover">
                @else
                    <div class="h-32 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">No Image</div>
                @endif

                <div class="p-4 space-y-2">
                    <h3 class="text-gray-800 font-semibold text-sm truncate">{{ $menu->name }}</h3>

                    <div class="text-green-600 font-bold text-sm">{{ $menu->formatted_price }}</div>

                    <div class="text-xs text-gray-500">
                        Category:
                        <span class="font-medium text-gray-700">{{ $menu->category->name ?? '—' }}</span>
                    </div>

                    <div>
                        @if($menu->available)
                            <span class="text-green-700 text-xs font-semibold bg-green-100 px-2 py-0.5 rounded-full">Available</span>
                        @else
                            <span class="text-red-700 text-xs font-semibold bg-red-100 px-2 py-0.5 rounded-full">Unavailable</span>
                        @endif
                    </div>

                    <div class="flex justify-between items-center pt-2 text-sm">
                        <a href="{{ route('admin.menus.show', $menu) }}" class="text-blue-600 hover:underline">Show</a>
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="text-indigo-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">No menu items found.</div>
        @endforelse
    </div>
@endsection
