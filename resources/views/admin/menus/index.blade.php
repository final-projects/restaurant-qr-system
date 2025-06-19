@extends('layouts.admin')

@section('title', 'Manage Menus')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-900">🍽️ Menu Management</h2>
        <a href="{{ route('admin.menus.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 text-sm font-medium rounded shadow transition">
            + Add New Item
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 border border-green-300 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
        {{-- Left Sidebar: QR Code --}}
        <div class="lg:col-span-1">
            <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">📱 Share Menu</h3>
                <div class="print-area flex justify-center">
                    {!! QrCode::size(180)->generate(route('menu.public.index')) !!}
                </div>
                <p class="text-xs text-gray-500 text-center mt-2">Scan to view menu</p>

                <button onclick="window.print()"
                        class="mt-4 w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-md shadow text-sm">
                    🖨️ Print QR Code
                </button>
            </div>
        </div>

        {{-- Right Content: Menu Items --}}
        <div class="lg:col-span-4">
            @if($menus->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($menus as $menu)
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                     class="w-full h-36 object-cover">
                            @else
                                <div class="h-36 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                    No Image
                                </div>
                            @endif

                            <div class="p-4 space-y-2">
                                <h3 class="text-gray-900 font-semibold text-base truncate">{{ $menu->name }}</h3>
                                <div class="text-green-600 font-bold text-sm">{{ $menu->formatted_price }}</div>

                                <div class="text-xs text-gray-500">
                                    Category: <span class="font-medium text-gray-700">{{ $menu->category->name ?? '—' }}</span>
                                </div>

                                <div>
                                    @if($menu->available)
                                        <span class="bg-green-100 text-green-700 text-xs font-medium px-2 py-0.5 rounded-full">Available</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 text-xs font-medium px-2 py-0.5 rounded-full">Unavailable</span>
                                    @endif
                                </div>

                                <div class="flex justify-between items-center pt-2 text-sm">
                                    <a href="{{ route('admin.menus.show', $menu) }}" class="text-blue-600 hover:underline">Show</a>
                                    <a href="{{ route('admin.menus.edit', $menu) }}" class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-500 mt-12 text-sm">No menu items found.</div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .print-area, .print-area * {
            visibility: visible;
        }
        .print-area {
            position: absolute;
            top: 0;
            left: 0;
        }
    }
</style>
@endpush
