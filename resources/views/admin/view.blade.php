<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details - Order #') . $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow sm:rounded-lg p-6 mb-6">
                <p><strong>Table:</strong> #{{ $order->table->table_number }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Created At:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>

                <form method="POST" action="{{ route('admin.status', $order->id) }}" class="mt-4">
                    @csrf
                    <label for="status">Update Status:</label>
                    <select name="status" id="status" class="border rounded p-2">
                        <option value="new" @selected($order->status === 'new')>New</option>
                        <option value="preparing" @selected($order->status === 'preparing')>Preparing</option>
                        <option value="completed" @selected($order->status === 'completed')>Completed</option>
                        <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                    </select>
                    <button type="submit" class="ml-2 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
                </form>

                <form method="POST" action="{{ route('admin.delete', $order->id) }}" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Delete Order</button>
                </form>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="font-semibold mb-2">Ordered Items</h3>
                <ul class="list-disc list-inside">
                    @foreach($order->orderItems as $item)
                        <li>{{ $item->menuItem->name }} × {{ $item->quantity }}</li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>
