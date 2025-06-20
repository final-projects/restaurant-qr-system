<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'QR Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar for desktop -->
        <aside class="hidden md:flex flex-col w-64 bg-white shadow-lg">
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-indigo-700">🍽 QR Admin</h1>
            </div>
            <nav class="p-4 space-y-2 text-sm flex-1">
                <x-admin-nav-link route="admin.dashboard" icon="📊" label="Dashboard"/>
                <x-admin-nav-link route="admin.orders.index" icon="🧾" label="Orders"/>
                <x-admin-nav-link route="admin.tables.index" icon="🍽️" label="Tables"/>
                <x-admin-nav-link route="admin.menus.index" icon="📋" label="Menus"/>
                <x-admin-nav-link route="admin.categories.index" icon="🗂️" label="Categories"/>
                <x-admin-nav-link route="admin.settings" icon="⚙️" label="Settings"/>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="w-full text-left text-red-600 px-4 py-2 hover:bg-red-100 rounded">
                        🚪 Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Mobile sidebar overlay -->
        <div
            class="fixed inset-0 z-30 bg-black bg-opacity-40 md:hidden"
            x-show="sidebarOpen"
            @click="sidebarOpen = false"
            x-transition.opacity
            x-cloak
        ></div>

        <!-- Sidebar for mobile -->
        <aside
            class="fixed z-40 inset-y-0 left-0 w-64 bg-white shadow-md transform md:hidden transition-transform duration-300"
            x-show="sidebarOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            @click.away="sidebarOpen = false"
            x-cloak
        >
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-indigo-700">🍽 QR Admin</h1>
            </div>
            <nav class="p-4 space-y-2 text-sm">
                <x-admin-nav-link route="admin.dashboard" icon="📊" label="Dashboard" @click="sidebarOpen = false"/>
                <x-admin-nav-link route="admin.orders.index" icon="🧾" label="Orders" @click="sidebarOpen = false"/>
                <x-admin-nav-link route="admin.tables.index" icon="🍽️" label="Tables" @click="sidebarOpen = false"/>
                <x-admin-nav-link route="admin.menus.index" icon="📋" label="Menus" @click="sidebarOpen = false"/>
                <x-admin-nav-link route="admin.categories.index" icon="🗂️" label="Categories" @click="sidebarOpen = false"/>
                <x-admin-nav-link route="admin.settings" icon="⚙️" label="Settings" @click="sidebarOpen = false"/>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left text-red-600 px-4 py-2 hover:bg-red-100 rounded">
                        🚪 Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top bar -->
            <header class="flex items-center justify-between bg-white border-b px-4 py-3 shadow">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-700 focus:outline-none">
                    <!-- Hamburger icon -->
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h2 class="text-lg font-semibold">@yield('title', 'Dashboard')</h2>
                <span class="text-sm text-gray-500 hidden md:block">
                    {{ Auth::guard('admin')->user()->name ?? 'Guest' }}
                </span>
            </header>

            <!-- Page content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
