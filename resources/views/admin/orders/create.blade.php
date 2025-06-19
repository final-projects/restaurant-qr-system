@extends('layouts.admin')

@section('title', 'Create New Order')

@section('content')
    <div class="bg-white shadow-lg rounded-xl p-8 max-w-5xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">🧾 Create New Order</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 underline">← Back to Orders</a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-6 text-sm">
                <ul class="list-disc ps-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.orders.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- User --}}
            <div>
                <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-1">👤 User (Optional)</label>
                <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">-- Select User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Table --}}
            <div>
                <label for="table_id" class="block text-sm font-semibold text-gray-700 mb-1">🪑 Select Table</label>
                <select name="table_id" id="table_id" required class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">-- Choose Table --</option>
                    @foreach($tables as $table)
                        <option value="{{ $table->id }}">Table #{{ $table->table_number }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Menu Items --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">🍽️ Menu Items</label>
                <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($menus as $menu)
                        <div class="border rounded-lg p-4 bg-gray-50 hover:bg-gray-100 transition">
                            <label class="flex items-center gap-2 mb-2">
                                <input type="checkbox" class="menu-checkbox" data-id="{{ $menu->id }}">
                                <span class="font-semibold text-gray-800">{{ $menu->name }}</span>
                            </label>
                            <div class="text-xs text-gray-500 mb-1">{{ $menu->category->name ?? 'No Category' }}</div>
                            <div class="text-sm text-green-600 mb-2">{{ number_format($menu->price, 2) }} EGP</div>

                            <div class="menu-inputs" id="menu-input-{{ $menu->id }}" style="display: none;">
                                <input type="hidden" name="menus[{{ $menu->id }}][id]" value="{{ $menu->id }}">
                                <label class="block text-xs text-gray-600 mb-1">Quantity</label>
                                <input type="number" name="menus[{{ $menu->id }}][quantity]" min="1" value="1"
                                    class="w-full px-2 py-1 border border-gray-300 rounded text-sm" />
                            </div>
                        </div>
                    @endforeach
                </div>
                <p class="text-xs text-gray-500 mt-1">Select items to include in the order. Quantity defaults to 1.</p>
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">📦 Order Status</label>
                <select name="status" id="status" required class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="new" selected>New</option>
                    <option value="preparing">Preparing</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            {{-- Submit --}}
            <div class="pt-6 text-end">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-md shadow">
                    ➕ Create Order
                </button>
            </div>
        </form>
    </div>

    {{-- JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.menu-checkbox').forEach((checkbox) => {
                checkbox.addEventListener('change', function () {
                    const id = this.dataset.id;
                    const inputDiv = document.getElementById('menu-input-' + id);
                    if (this.checked) {
                        inputDiv.style.display = 'block';
                    } else {
                        inputDiv.style.display = 'none';
                        inputDiv.querySelector('input[type="number"]').value = 1;
                    }
                });
            });
        });
    </script>
@endsection
