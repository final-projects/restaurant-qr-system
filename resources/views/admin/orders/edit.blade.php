@extends('layouts.admin')

@section('title', 'Edit Order')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Edit Order #{{ $order->id }}</h2>

        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="table_id" class="block text-sm font-medium text-gray-700">Table</label>
                <select name="table_id" id="table_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($tables as $table)
                        <option value="{{ $table->id }}" @selected($table->id === $order->table_id)>
                            Table #{{ $table->table_number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="pending" @selected($order->status == 'pending')>Pending</option>
                    <option value="processing" @selected($order->status == 'processing')>Processing</option>
                    <option value="completed" @selected($order->status == 'completed')>Completed</option>
                </select>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Update Order
            </button>
        </form>
    </div>
@endsection
