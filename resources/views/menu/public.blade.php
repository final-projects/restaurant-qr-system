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
    <main class="py-12 px-4 max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Explore Our Best Dishes</h2>
            <p class="text-sm text-gray-500 mt-2">Fresh • Organic • Delicious</p>
        </div>

        <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($menus as $menu)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl overflow-hidden menu-card group transition-all duration-300">
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}"
                             alt="{{ $menu->name }}"
                             class="h-44 w-full object-cover menu-img">
                    @else
                        <div class="h-44 flex items-center justify-center bg-gray-100 text-gray-400">No Image</div>
                    @endif

                    <div class="p-5 space-y-2">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-bold text-gray-800 truncate">{{ $menu->name }}</h3>
                            <span class="text-sm text-green-600 font-bold">{{ number_format($menu->price, 2) }} EGP</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <p class="text-xs text-gray-500">
                                {{ $menu->category->name ?? 'Uncategorized' }}
                            </p>

                            @if($menu->available)
                                <span class="text-xs font-semibold text-green-700 bg-green-100 px-2 py-0.5 rounded-full">Available</span>
                            @else
                                <span class="text-xs font-semibold text-red-700 bg-red-100 px-2 py-0.5 rounded-full">Unavailable</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($menus->isEmpty())
            <div class="text-center text-gray-500 mt-12">Currently no menu items available. Check back later!</div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="text-center text-xs text-gray-400 py-6 mt-10">
        &copy; {{ date('Y') }} Your Restaurant. All rights reserved.
    </footer>

</body>
</html>
