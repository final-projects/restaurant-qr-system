<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-5 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-indigo-600">🍽️ Our Menu</h1>
            <span class="text-sm text-gray-500">Fresh & Delicious</span>
        </div>
    </header>

    <main class="py-10 px-4 max-w-7xl mx-auto">
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($menus as $menu)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                             class="h-40 w-full object-cover">
                    @else
                        <div class="h-40 flex items-center justify-center bg-gray-100 text-gray-400">
                            No Image
                        </div>
                    @endif

                    <div class="p-4 space-y-1">
                        <h3 class="text-lg font-semibold truncate text-gray-800">{{ $menu->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $menu->category->name ?? 'Uncategorized' }}</p>

                        <div class="flex justify-between items-center pt-2">
                            <span class="text-green-600 font-bold">{{ number_format($menu->price, 2) }} EGP</span>
                            @if($menu->available)
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Available</span>
                            @else
                                <span class="text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded-full">Unavailable</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($menus->isEmpty())
            <div class="text-center text-gray-500 mt-10">No menu items available right now.</div>
        @endif
    </main>

    <footer class="text-center text-xs text-gray-400 py-6">
        &copy; {{ date('Y') }} Your Restaurant. All rights reserved.
    </footer>

</body>
</html>
