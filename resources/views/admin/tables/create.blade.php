@extends('layouts.admin')

@section('title', 'Create Table')

@section('content')
    <div class="bg-white p-6 shadow rounded-lg max-w-xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Create New Table</h2>

        <form action="{{ route('admin.tables.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="table_number" class="block text-sm font-medium text-gray-700">Table Number</label>
                <input type="number" name="table_number" id="table_number" value="{{ old('table_number') }}"
                    class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label for="seats" class="block text-sm font-medium text-gray-700">Seats</label>
                <input type="number" name="seats" id="seats" value="{{ old('seats', 2) }}"
                    class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2">
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                </select>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Save Table
            </button>
        </form>
    </div>
@endsection
