<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Our Signature Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .menu-card:hover .menu-img {
            transform: scale(1.05);
            transition: transform 0.4s ease;
        }
    </style>
</head>

<body class="bg-gradient-to-tr from-white via-gray-50 to-white text-gray-800">

    <!-- Header -->
    <header class="bg-white/70 backdrop-blur shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold text-indigo-700 tracking-tight">🍽️ Our Signature Menu</h1>
            <span class="text-sm text-gray-500">Crafted with Love ❤️</span>
        </div>
    </header>

    <!-- Main -->
    <main class="py-10 px-4 max-w-7xl mx-auto">

        {{-- ✅ Success & Error Messages --}}
        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 text-sm px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 text-sm px-4 py-3 rounded">
                <ul class="list-disc ps-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- 🪑 Table Info --}}
        <div class="max-w-2xl mx-auto mb-10 bg-white rounded-xl shadow px-6 py-4 border border-gray-200">
            <h3 class="text-lg font-bold text-indigo-700 mb-2">🪑 You are ordering for Table #{{ $table->table_number }}
            </h3>
            <ul class="text-sm text-gray-600 space-y-1">
                <li><strong>Table Number:</strong> {{ $table->table_number }}</li>
                <li><strong>Total Seats:</strong> {{ $table->seats }}</li>
                <li><strong>Status:</strong>
                    @if ($table->status === 'available')
                        <span class="text-green-600 font-semibold">Available</span>
                    @elseif($table->status === 'occupied')
                        <span class="text-red-600 font-semibold">Occupied</span>
                    @else
                        <span class="text-gray-600 font-semibold">{{ ucfirst($table->status) }}</span>
                    @endif
                </li>
                <li><strong>QR Token:</strong> {{ $table->qr_token }}</li>
            </ul>
        </div>

        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Explore Our Best Dishes</h2>
            <p class="text-sm text-gray-500 mt-2">Fresh • Organic • Delicious</p>
        </div>

        <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($menus as $menu)
                @php
                    $selectedQty = old("quantity_{$menu->id}") ?? 0;
                    $existingQty = $activeOrder?->menus->firstWhere('id', $menu->id)?->pivot->quantity ?? 0;
                @endphp

                <div
                    class="bg-white rounded-xl shadow-lg hover:shadow-2xl overflow-hidden menu-card group transition-all duration-300
                {{ $selectedQty > 0 || $existingQty > 0 ? 'border-2 border-green-400 ring-1 ring-green-200' : '' }}">

                    @if ($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                            class="h-44 w-full object-cover menu-img">
                    @else
                        <div class="h-44 flex items-center justify-center bg-gray-100 text-gray-400">No Image</div>
                    @endif

                    <div class="p-5 space-y-2">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-bold text-gray-800 truncate">
                                {{ $menu->name }}
                                @if ($selectedQty > 0)
                                    <span class="text-green-600 text-xs font-semibold">✔ Selected</span>
                                @endif
                            </h3>
                            <span class="text-sm text-green-600 font-bold">{{ number_format($menu->price, 2) }}
                                EGP</span>
                        </div>

                        {{-- ✅ Show existing quantity in order if any --}}
                        @if ($existingQty > 0)
                            <div class="text-xs text-green-700 bg-green-100 px-2 py-0.5 rounded w-fit">
                                🛒 In Order: {{ $existingQty }}
                            </div>
                        @endif

                        <div class="flex justify-between items-center">
                            <p class="text-xs text-gray-500">
                                {{ $menu->category->name ?? 'Uncategorized' }}
                            </p>

                            @if ($menu->available)
                                <span
                                    class="text-xs font-semibold text-green-700 bg-green-100 px-2 py-0.5 rounded-full">Available</span>
                            @else
                                <span
                                    class="text-xs font-semibold text-red-700 bg-red-100 px-2 py-0.5 rounded-full">Unavailable</span>
                            @endif
                        </div>

                        {{-- ✅ Add to Order Form --}}
                        <form action="{{ route('submit.public.menu', ['table' => $table->id, 'menu' => $menu->id]) }}"
                            method="POST" class="mt-3 space-y-2">
                            @csrf
                            <label for="qty_{{ $menu->id }}" class="block text-xs text-gray-600">Quantity</label>
                            <input type="number" min="1" name="quantity" id="qty_{{ $menu->id }}"
                                class="w-full border rounded px-2 py-1 text-sm"
                                value="{{ old("quantity_{$menu->id}", 1) }}">

                            <button type="submit"
                                class="w-full bg-indigo-600 text-white text-sm py-1.5 rounded hover:bg-indigo-700 transition">
                                ➕ Add to Order
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>

        @if ($menus->isEmpty())
            <div class="text-center text-gray-500 mt-12">Currently no menu items available. Check back later!</div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="text-center text-xs text-gray-400 py-6 mt-10">
        &copy; {{ date('Y') }} Your Restaurant. All rights reserved.
    </footer>

</body>

</html>
