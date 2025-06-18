@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
    <div class="max-w-4xl mx-auto py-10">

        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Admin Settings</h2>

        {{-- General Settings --}}
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">General Information</h3>
            <form method="POST" action="#">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Site Name</label>
                        <input type="text" name="site_name" value="QR Restaurant" class="mt-1 block w-full rounded-md shadow-sm border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Admin Email</label>
                        <input type="email" name="admin_email" value="admin@example.com" class="mt-1 block w-full rounded-md shadow-sm border-gray-300" />
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">Save Changes</button>
                </div>
            </form>
        </div>

        {{-- Security Settings --}}
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Security</h3>
            <form method="POST" action="#">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Change Password</label>
                        <input type="password" name="new_password" class="mt-1 block w-full rounded-md shadow-sm border-gray-300" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input type="password" name="confirm_password" class="mt-1 block w-full rounded-md shadow-sm border-gray-300" />
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">Update Password</button>
                </div>
            </form>
        </div>

        {{-- Other Settings (optional future sections) --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Other Settings</h3>
            <p class="text-sm text-gray-500">More settings can be added here in the future.</p>
        </div>
    </div>
@endsection
