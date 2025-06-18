<x-guest-layout>
    <!-- Hero Section -->
    <section class="bg-white shadow py-24">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div>
                <h1 class="text-5xl font-extrabold text-gray-900 mb-6">Contactless Restaurant Ordering System</h1>
                <p class="text-gray-600 text-lg mb-6">
                    Let customers scan a QR code, view your digital menu, and place orders from their seats — fast,
                    safe, and easy.
                </p>
                <a href="{{ route('register') }}"
                    class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700">Get Started</a>
            </div>
            <div class="text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" alt="QR Ordering" class="w-3/4 mx-auto">
            </div>
        </div>
    </section>

    <main class="flex-1 py-16 space-y-24">
        <!-- Features -->
        <section id="features" class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold mb-6 text-center">Powerful Features</h2>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="bg-white p-6 rounded shadow text-center">
                    <h4 class="text-xl font-semibold mb-2">QR Code Scanning</h4>
                    <p class="text-gray-600">Each table gets a unique QR to access your menu instantly.</p>
                </div>
                <div class="bg-white p-6 rounded shadow text-center">
                    <h4 class="text-xl font-semibold mb-2">Smart Menu</h4>
                    <p class="text-gray-600">Dynamic digital menu that supports categories, prices, and images.</p>
                </div>
                <div class="bg-white p-6 rounded shadow text-center">
                    <h4 class="text-xl font-semibold mb-2">Admin Dashboard</h4>
                    <p class="text-gray-600">Manage all orders, track statuses, and control your menu easily.</p>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section id="how-it-works" class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold mb-6 text-center">How It Works</h2>
            <div class="grid md:grid-cols-2 gap-10">
                <div>
                    <h3 class="text-xl font-semibold mb-2">Customer Side</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>Scan the QR code placed on the table</li>
                        <li>View the interactive menu in your browser</li>
                        <li>Add items to your order</li>
                        <li>Confirm the order and wait</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-2">Admin Side</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>Login to the dashboard</li>
                        <li>Monitor all live orders</li>
                        <li>Change status: Preparing / Ready</li>
                        <li>Manage menu & settings</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section id="testimonials" class="bg-white py-16">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6">What Restaurants Say</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-gray-50 p-6 rounded shadow">
                        <p class="text-gray-700 italic">"We reduced order mistakes and improved speed by 30%! Highly
                            recommend it."</p>
                        <p class="mt-4 font-semibold">– Mia's Bistro</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded shadow">
                        <p class="text-gray-700 italic">"Our staff loves it. It’s easy to use, and customers enjoy the
                            convenience."</p>
                        <p class="mt-4 font-semibold">– The Grill Spot</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section id="faq" class="max-w-5xl mx-auto px-6">
            <h2 class="text-3xl font-bold mb-6 text-center">Frequently Asked Questions</h2>
            <div class="space-y-6">
                <div>
                    <h4 class="font-semibold text-lg">Do customers need to download an app?</h4>
                    <p class="text-gray-600">No. Everything works directly from their phone’s browser after scanning the
                        QR code.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-lg">Can I customize my menu?</h4>
                    <p class="text-gray-600">Yes! You can add categories, prices, descriptions, and images easily from
                        your dashboard.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-lg">How are orders received?</h4>
                    <p class="text-gray-600">Orders appear instantly on your admin dashboard in real-time.</p>
                </div>
            </div>
        </section>

        <!-- Pricing -->
        <section id="pricing" class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold mb-6 text-center">Simple Pricing</h2>
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div class="bg-white p-6 rounded shadow border">
                    <h3 class="text-xl font-semibold mb-2">Starter</h3>
                    <p class="text-gray-600 mb-4">For small restaurants</p>
                    <p class="text-2xl font-bold mb-4">Free</p>
                    <p class="text-gray-600">Basic QR Menu<br>1 Admin Account<br>Email Support</p>
                </div>
                <div class="bg-indigo-50 p-6 rounded shadow border-2 border-indigo-600">
                    <h3 class="text-xl font-semibold mb-2">Pro</h3>
                    <p class="text-gray-600 mb-4">For growing restaurants</p>
                    <p class="text-2xl font-bold mb-4">$19/month</p>
                    <p class="text-gray-600">Unlimited Menus<br>Order Dashboard<br>QR Generator</p>
                </div>
                <div class="bg-white p-6 rounded shadow border">
                    <h3 class="text-xl font-semibold mb-2">Enterprise</h3>
                    <p class="text-gray-600 mb-4">For large chains</p>
                    <p class="text-2xl font-bold mb-4">Custom</p>
                    <p class="text-gray-600">Dedicated Support<br>Custom Integrations<br>Multi-Branch Support</p>
                </div>
            </div>
        </section>

        <!-- Contact CTA -->
        <section id="contact" class="bg-indigo-600 text-white py-16">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-4">Ready to Modernize Your Restaurant?</h2>
                <p class="mb-6">Contact our team and get started today with a free setup!</p>
                <a href="mailto:support@qrrestaurant.com"
                    class="bg-white text-indigo-700 font-semibold px-6 py-3 rounded shadow hover:bg-gray-100">Email
                    Us</a>
            </div>
        </section>
    </main>
</x-guest-layout>
