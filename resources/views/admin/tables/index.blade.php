@extends('layouts.admin')

@section('title', 'Manage Tables')

@section('content')
    <div class="bg-white p-6 shadow rounded-lg">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">All Tables</h2>
            <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                + Add New Table
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white text-left border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 text-sm font-semibold text-gray-600 border-b">ID</th>
                        <th class="py-2 px-4 text-sm font-semibold text-gray-600 border-b">Table Number</th>
                        <th class="py-2 px-4 text-sm font-semibold text-gray-600 border-b">Status</th>
                        <th class="py-2 px-4 text-sm font-semibold text-gray-600 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tables as $table)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-2 px-4 border-b">{{ $table->id }}</td>
                            <td class="py-2 px-4 border-b">Table #{{ $table->table_number }}</td>
                            <td class="py-2 px-4 border-b capitalize">{{ $table->status }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="#" class="text-indigo-600 hover:underline">Edit</a>
                                |
                                <a href="#" class="text-red-600 hover:underline">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">No tables found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
