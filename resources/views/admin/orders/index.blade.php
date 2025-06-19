@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">All Orders</h2>
            <a href="{{ route('admin.orders.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 text-sm">
                ➕ Create New Order
            </a>
        </div>
        @if($orders->count())
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Table</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Created</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800">#{{ $order->id }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">Table #{{ $order->table->table_number }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 capitalize">{{ $order->status }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $order->created_at->format('Y-m-d H:i') }}</td>
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
            </div>
        @else
            <p class="text-gray-500">No orders found.</p>
        @endif
    </div>
@endsection
