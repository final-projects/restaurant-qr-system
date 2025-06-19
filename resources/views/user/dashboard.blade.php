<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🍽️ Welcome, {{ Auth::user()->name }} 👋
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Total Orders --}}
                <div class="bg-white border-l-4 border-indigo-600 shadow-md rounded-lg p-5">
                    <div class="text-sm text-gray-500 mb-1">Total Orders</div>
                    <div class="text-3xl font-bold text-indigo-600">{{ $orders_count }}</div>
                </div>

                {{-- Orders In Progress --}}
                <div class="bg-white border-l-4 border-yellow-500 shadow-md rounded-lg p-5">
                    <div class="text-sm text-gray-500 mb-1">Orders In Progress</div>
                    <div class="text-3xl font-bold text-yellow-600">{{ $orders_preparing }}</div>
                </div>

                {{-- Completed Orders --}}
                <div class="bg-white border-l-4 border-green-500 shadow-md rounded-lg p-5">
                    <div class="text-sm text-gray-500 mb-1">Completed Orders</div>
                    <div class="text-3xl font-bold text-green-600">{{ $orders_completed }}</div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('user.orders.create') }}"
                   class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow">
                    ➕ Place New Order
                </a>

                <a href="{{ route('user.menus.index') }}"
                   class="flex items-center justify-center bg-white border hover:bg-gray-50 text-gray-700 font-semibold py-3 rounded-lg transition duration-200 shadow">
                    📖 Browse Menu
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
