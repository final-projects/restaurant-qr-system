@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <h2 class="text-2xl font-bold mb-4">All Orders</h2>

    @foreach($orders as $order)
        <div class="mb-4 p-4 bg-white shadow rounded">
            <strong>Order #{{ $order->id }}</strong> -
            Table: {{ $order->table->table_number }} -
            Status: {{ $order->status }}
        </div>
    @endforeach
@endsection
