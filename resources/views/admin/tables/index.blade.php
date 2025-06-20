@extends('layouts.admin')

@section('title', 'Manage Tables')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Restaurant Tables</h2>
        <a href="{{ route('admin.tables.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            + Add New Table
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-6">
        @forelse($tables as $table)
            <div class="flex flex-col items-center p-4 bg-white shadow rounded-lg transition hover:shadow-md border">

                {{-- Table circle --}}
                <div class="relative w-24 h-24 rounded-full flex items-center justify-center bg-white border-4
                    {{ $table->status === 'available' ? 'border-green-500' : 'border-red-500' }}">

                    {{-- Table SVG --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#4B5563" viewBox="0 0 24 24" class="w-10 h-10">
                        <path d="M3 5a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v3h-2v11a1 1 0 1 1-2 0V8H8v11a1 1 0 1 1-2 0V8H4V5z"/>
                    </svg>

                    {{-- Chairs --}}
                    @for($i = 0; $i < $table->seats; $i++)
                        @php
                            $angle = (360 / $table->seats) * $i;
                            $x = 36 + 40 * cos(deg2rad($angle));
                            $y = 36 + 40 * sin(deg2rad($angle));
                        @endphp
                        <svg class="absolute w-4 h-4 text-gray-600" style="top: {{ $y }}px; left: {{ $x }}px;" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 3a2 2 0 00-2 2v3h14V5a2 2 0 00-2-2H5zM3 9v6a1 1 0 001 1h1v-3a1 1 0 112 0v3h6v-3a1 1 0 112 0v3h1a1 1 0 001-1V9H3z" />
                        </svg>
                    @endfor
                </div>

                {{-- Table info --}}
                <div class="mt-2 font-semibold text-gray-800 text-sm">Table #{{ $table->table_number }}</div>
                <div class="mt-1 text-xs text-gray-500">Seats: {{ $table->seats }}</div>

                {{-- QR Code --}}
                <div class="mt-2">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ route('show.public.menu', $table->id) }}"
                         alt="QR Code"
                         class="w-12 h-12 cursor-pointer transition hover:scale-110"
                         onclick="showQRModal('{{ route('show.public.menu', $table->id) }}')">
                </div>

                {{-- Status --}}
                <div class="mt-2 text-xs font-medium {{ $table->status === 'available' ? 'text-green-600' : 'text-red-600' }}">
                    {{ ucfirst($table->status) }}
                </div>

                {{-- Actions --}}
                <div class="mt-3 flex gap-2 text-sm">
                    <a href="{{ route('admin.tables.show', $table) }}" class="text-blue-600 hover:underline">Show</a>
                    <a href="{{ route('admin.tables.edit', $table) }}" class="text-indigo-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.tables.destroy', $table) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">No tables found.</div>
        @endforelse
    </div>

    {{-- QR Modal --}}
    <div id="qrModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full relative text-center">
            <button onclick="closeQRModal()" class="absolute top-2 right-2 text-gray-600 hover:text-red-600 text-xl">&times;</button>
            <h3 class="text-lg font-semibold mb-4">QR Code</h3>
            <img id="qrImage" src="" class="mx-auto w-48 h-48 mb-3">
            <input id="qrLink" type="text" class="w-full border border-gray-300 rounded px-2 py-1 text-sm text-center" readonly>
            <button onclick="navigator.clipboard.writeText(document.getElementById('qrLink').value)" class="mt-2 bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 text-sm">Copy Link</button>
        </div>
    </div>

    <script>
        function showQRModal(link) {
            document.getElementById('qrImage').src = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" + encodeURIComponent(link);
            document.getElementById('qrLink').value = link;
            document.getElementById('qrModal').classList.remove('hidden');
            document.getElementById('qrModal').classList.add('flex');
        }

        function closeQRModal() {
            document.getElementById('qrModal').classList.add('hidden');
            document.getElementById('qrModal').classList.remove('flex');
        }
    </script>
@endsection
