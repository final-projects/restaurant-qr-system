@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Order #{{ $order->id }}</h2>

        <p><strong>Table:</strong> Table #{{ $order->table->table_number }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Created At:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>

        <a href="{{ route('admin.orders.edit', $order->id) }}" class="inline-block mt-4 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
            Edit Order
        </a>
    </div>
@endsection
