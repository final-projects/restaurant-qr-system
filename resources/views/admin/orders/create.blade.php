@extends('layouts.admin')

@section('title', 'Create New Order')

@section('content')
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">🧾 Create New Order</h2>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc ms-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.orders.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Select Table --}}
            <div>
                <label for="table_id" class="block text-sm font-medium text-gray-700 mb-1">Table</label>
                <select name="table_id" id="table_id" required class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">-- Select Table --</option>
                    @foreach($tables as $table)
                        <option value="{{ $table->id }}">Table #{{ $table->table_number }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Select Menu Items --}}
            <div>
                <label for="items" class="block text-sm font-medium text-gray-700 mb-1">Menu Items</label>
                <div class="grid md:grid-cols-2 gap-2">
                    @foreach($menus as $menu)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="items[]" value="{{ $menu->id }}" class="text-indigo-600">
                            <span>{{ $menu->name }} ({{ $menu->category->name ?? 'No Category' }})</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
                    Create Order
                </button>
            </div>
        </form>
    </div>
@endsection

