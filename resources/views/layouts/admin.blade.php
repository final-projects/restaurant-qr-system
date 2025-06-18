<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Order Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Sidebar + Main layout -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg hidden md:block">
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-indigo-700">QR Admin</h1>
            </div>
            <nav class="p-6 space-y-4 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">📊 Dashboard</a>
                <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">🧾 Orders</a>
                <a href="{{ route('admin.tables.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">🍽️ Tables</a>
                <a href="{{ route('admin.menus.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">📋 Menus</a>
                <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">🗂️ Categories</a>
                <a href="{{ route('admin.settings') }}" class="block px-4 py-2 rounded hover:bg-indigo-100 text-gray-700">⚙️ Settings</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-6">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-600">🚪 Logout</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Header -->
            <header class="bg-white shadow px-6 py-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                <div class="text-sm text-gray-600">
                    Admin: {{ Auth::guard('admin')->user()->name ?? 'Guest' }}
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>

    </div>

</body>
</html>
