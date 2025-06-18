@extends('layouts.admin')

@section('title', 'Orders Overview')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Orders Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="bg-indigo-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 3h18M9 3v18m6-18v18M3 9h18M3 15h18"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-sm text-gray-600">Orders</h4>
                    <p class="text-2xl font-semibold text-gray-900">{{ $ordersCount }}</p>
                </div>
            </div>
        </div>

        <!-- Tables Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-sm text-gray-600">Tables</h4>
                    <p class="text-2xl font-semibold text-gray-900">{{ $tablesCount }}</p>
                </div>
            </div>
        </div>

        <!-- Categories Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-sm text-gray-600">Categories</h4>
                    <p class="text-2xl font-semibold text-gray-900">{{ $categoriesCount }}</p>
                </div>
            </div>
        </div>

        <!-- Menu Items Card -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-sm text-gray-600">Menu Items</h4>
                    <p class="text-2xl font-semibold text-gray-900">{{ $menuItemsCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded p-6 mt-6">
        <h3 class="text-lg font-semibold mb-4">Recent Orders</h3>
        @if($recentOrders->isEmpty())
            <p class="text-gray-500">No recent orders.</p>
        @else
            <table class="w-full table-auto text-sm">
                <thead class="text-left bg-gray-50">
                <tr>
                    <th class="px-4 py-2">#ID</th>
                    <th class="px-4 py-2">Table</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recentOrders as $order)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $order->id }}</td>
                        <td class="px-4 py-2">#{{ $order->table->table_number ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ ucfirst($order->status) }}</td>
                        <td class="px-4 py-2">{{ $order->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection
