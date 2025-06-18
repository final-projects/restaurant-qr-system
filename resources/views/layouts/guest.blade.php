<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'QR Restaurant') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto py-4 px-6 flex justify-between items-center">
            <a href="{{ route('home') }}"class="flex items-center gap-3">
                <img src="{{ asset('logo.png') }}" alt="QR Logo" class="h-12 w-auto">
                <span class="text-2xl font-bold text-gray-800">QR Restaurant</span>
            </a>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200 transition">Register</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div>
        {{ $slot }}

    </div>

    <!-- Footer -->
    <footer class="bg-white border-t mt-12 py-6 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} QR Restaurant Ordering System. All rights reserved.
    </footer>
</body>
</html>

