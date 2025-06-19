@extends('layouts.admin')

@section('title', 'Edit Table')

@section('content')
    <div class="bg-white p-6 shadow rounded-lg max-w-xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Table #{{ $table->table_number }}</h2>

        <form action="{{ route('admin.tables.update', $table) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="table_number" class="block text-sm font-medium text-gray-700">Table Number</label>
                <input type="number" name="table_number" id="table_number" value="{{ old('table_number', $table->table_number) }}"
                    class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label for="seats" class="block text-sm font-medium text-gray-700">Seats</label>
                <input type="number" name="seats" id="seats" value="{{ old('seats', $table->seats) }}"
                    class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
                    <option value="available" {{ $table->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ $table->status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                </select>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Update Table
            </button>
        </form>
    </div>
@endsection
