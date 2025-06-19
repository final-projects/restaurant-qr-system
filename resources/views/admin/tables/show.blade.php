@extends('layouts.admin')

@section('title', 'Table Details')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow border max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Table #{{ $table->table_number }}</h2>
            <a href="{{ route('admin.tables.edit', $table) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 text-sm rounded shadow">
                Edit Table
            </a>
        </div>

        <div class="grid gap-4 text-sm text-gray-700">
            {{-- Table Number --}}
            <div>
                <span class="block text-gray-500 mb-1">Table Number</span>
                <span class="text-base font-semibold">#{{ $table->table_number }}</span>
            </div>

            {{-- Seats --}}
            <div>
                <span class="block text-gray-500 mb-1">Seats</span>
                <div class="flex items-center gap-1 flex-wrap">
                    @for($i = 0; $i < $table->seats; $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5 3a2 2 0 00-2 2v3h14V5a2 2 0 00-2-2H5zM3 9v6a1 1 0 001 1h1v-3a1 1 0 112 0v3h6v-3a1 1 0 112 0v3h1a1 1 0 001-1V9H3z" />
                        </svg>
                    @endfor
                    <span class="ml-2 font-medium text-gray-800">{{ $table->seats }} seat(s)</span>
                </div>
            </div>

            {{-- Status --}}
            <div>
                <span class="block text-gray-500 mb-1">Status</span>
                <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                    {{ $table->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ ucfirst($table->status) }}
                </span>
            </div>

            {{-- Created At --}}
            <div>
                <span class="block text-gray-500 mb-1">Created At</span>
                <span class="text-sm">{{ $table->created_at->format('Y-m-d H:i') }}</span>
            </div>

            {{-- QR Code --}}
            <div>
                <span class="block text-gray-500 mb-1">QR Code</span>
                <div class="w-fit cursor-pointer hover:scale-105 transition" onclick="document.getElementById('qr-modal').classList.remove('hidden')">
                    {!! QrCode::size(80)->generate(url('/table/' . $table->qr_token)) !!}
                </div>
                <a href="{{ url('/table/' . $table->qr_token) }}" target="_blank" class="text-xs text-blue-600 hover:underline break-all mt-2 inline-block">
                    {{ url('/table/' . $table->qr_token) }}
                </a>
            </div>
        </div>

        {{-- Back Link --}}
        <div class="mt-6">
            <a href="{{ route('admin.tables.index') }}" class="text-gray-500 hover:text-gray-700 text-sm underline">
                ← Back to Tables
            </a>
        </div>
    </div>

    {{-- QR Modal --}}
    <div id="qr-modal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center relative max-w-sm w-full">
            <button onclick="document.getElementById('qr-modal').classList.add('hidden')" class="absolute top-2 right-3 text-gray-400 hover:text-gray-600 text-xl font-bold">
                &times;
            </button>
            <h3 class="text-lg font-semibold mb-4 text-gray-800">QR Code - Table #{{ $table->table_number }}</h3>
            {!! QrCode::size(200)->generate(url('/table/' . $table->qr_token)) !!}
            <a href="{{ url('/table/' . $table->qr_token) }}" target="_blank" class="block text-blue-600 hover:underline text-sm mt-4 break-all">
                {{ url('/table/' . $table->qr_token) }}
            </a>
        </div>
    </div>
@endsection
