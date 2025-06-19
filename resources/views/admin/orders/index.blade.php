@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <div class="bg-white p-6 rounded shadow max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">📋 All Orders</h2>
            <a href="{{ route('admin.orders.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 text-sm">
                ➕ Create New Order
            </a>
        </div>

        @if($orders->count())
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-200 shadow-sm rounded">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600">#</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600">Table</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600">User</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600">Items</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600">Created At</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800 font-medium">#{{ $order->id }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">Table #{{ $order->table->table_number }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">
                                    {{ $order->user?->name ?? '—' }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-800">
                                    {{ $order->menus->sum('pivot.quantity') }} item(s)
                                </td>
                                <td class="px-4 py-2 text-sm capitalize text-gray-800">
                                    <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                                        @if($order->status === 'new') bg-yellow-100 text-yellow-800
                                        @elseif($order->status === 'preparing') bg-blue-100 text-blue-800
                                        @elseif($order->status === 'completed') bg-green-100 text-green-800
                                        @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    {{ $order->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="px-4 py-2 text-sm space-x-2">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="text-blue-600 hover:underline">View</a>
                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                       class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')"
                                                class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6">
                    {{ $orders->links() }}
                </div>

            </div>
        @else
            <p class="text-gray-500 text-center mt-8">No orders found.</p>
        @endif
    </div>
@endsection
