@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
    <div class="max-w-3xl mx-auto bg-white border border-gray-200 p-6 rounded-xl shadow-sm mt-6 space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-indigo-700">
                🧾 Order #{{ $order->id }}
            </h2>
            <a href="{{ route('admin.orders.edit', $order->id) }}"
               class="inline-flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 text-sm font-semibold rounded hover:bg-yellow-600 transition">
                ✏️ Edit Order
            </a>
        </div>

        <div class="text-sm text-gray-700 space-y-2">
            <p><strong>📍 Table:</strong> Table #{{ $order->table->table_number }} (Seats: {{ $order->table->seats }})</p>
            <p><strong>📦 Status:</strong>
                @php
                    $statusColors = [
                        'new' => 'bg-blue-100 text-blue-800',
                        'preparing' => 'bg-yellow-100 text-yellow-800',
                        'completed' => 'bg-green-100 text-green-800',
                        'cancelled' => 'bg-red-100 text-red-800',
                        'old' => 'bg-gray-100 text-gray-800'
                    ];
                @endphp
                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>🕒 Created At:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
            <p><strong>💰 Total:</strong> {{ number_format($order->total_price, 2) }} EGP</p>
        </div>

        @if($order->menus && $order->menus->count())
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">🍽️ Ordered Items</h3>
                <ul class="space-y-2">
                    @foreach($order->menus as $menu)
                        <li class="flex justify-between text-sm border-b pb-1">
                            <span>{{ $menu->name }} <span class="text-gray-400">x {{ $menu->pivot->quantity }}</span></span>
                            <span class="font-medium">{{ number_format($menu->price * $menu->pivot->quantity, 2) }} EGP</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <p class="text-sm text-gray-500 mt-4">No items in this order yet.</p>
        @endif
    </div>
@endsection
