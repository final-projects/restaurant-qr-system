<x-guest-layout>
    <main class="flex-1 py-24 space-y-24">


        <!-- Register Section -->
        <section id="register" class="max-w-md mx-auto px-6">
            <div class="bg-white p-10 rounded-2xl shadow-lg border mt-10">
                <h2 class="text-3xl font-extrabold mb-6 text-center text-gray-800">Create an Account</h2>
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    {{-- Error Messages --}}
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="text-red-600 font-medium">There were some problems with your input:</div>
                            <ul class="mt-2 list-disc list-inside text-sm text-red-500">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" id="name" required
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                        <input type="email" name="email" id="email" required
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" id="password" required
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-150">Register</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</x-guest-layout>
