<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Place Your Order - Table #') . $table->table_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('order.submit') }}">
                @csrf
                <input type="hidden" name="table_id" value="{{ $table->id }}">
                <input type="hidden" name="token" value="{{ $table->qr_token }}">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($menuItems as $item)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="font-semibold text-lg">{{ $item->name }}</div>
                            <div class="text-sm text-gray-600 mb-2">EGP {{ $item->price }}</div>
                            <label for="item_{{ $item->id }}" class="block text-sm text-gray-700 mb-1">Quantity:</label>
                            <input id="item_{{ $item->id }}" name="items[{{ $item->id }}]" type="number" min="0" value="0"
                                   class="block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Submit Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
