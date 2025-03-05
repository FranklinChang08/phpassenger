<x-main-layout title="About Us">
    @section('header')
        @include('partials.navbar')
    @endsection
    @section('content')
        <div class="max-w-7xl mx-auto px-6 py-12 mt-12">
            <!-- Who We Are Section -->
            <section class="bg-white shadow-lg rounded-lg p-8 mb-12">
                <h2 class="text-3xl uppercase font-bold text-indigo-600 mb-4">Who We Are</h2>
                <p class="text-lg text-gray-700 leading-relaxed mb-8">
                    Welcome to our flight ticketing platform, where convenience meets efficiency. Our mission is to
                    revolutionize the way people travel by providing a seamless, reliable, and affordable ticketing solution
                    for everyone. Whether you're booking a domestic flight or an international journey, we ensure a smooth
                    experience from start to finish.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-indigo-600 rounded-lg p-6 shadow-md border border-gray-100">
                        <h3 class="font-bold text-xl text-white mb-2">24/7 Customer Support</h3>
                        <p class="text-white">
                            Our dedicated customer support team is available around the clock to assist you with any
                            inquiries or booking issues.
                        </p>
                    </div>
                    <div class="bg-indigo-600 rounded-lg p-6 shadow-md border border-gray-100">
                        <h3 class="font-bold text-xl text-white mb-2">Reliable Airlines</h3>
                        <p class="text-white">
                            We partner with trusted airlines to ensure a safe, comfortable, and punctual travel experience
                            for all passengers.
                        </p>
                    </div>
                    <div class="bg-indigo-600 rounded-lg p-6 shadow-md border border-gray-100">
                        <h3 class="font-bold text-xl text-white mb-2">Effortless Booking</h3>
                        <p class="text-white">
                            Our platform provides a fast, secure, and user-friendly experience to book your flight tickets
                            with ease.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Our Mission Section -->
            <section class="bg-gray-50 shadow-lg rounded-lg p-8 mb-12">
                <h2 class="text-3xl uppercase font-bold text-indigo-600 mb-4">Our Mission</h2>
                <p class="text-lg text-gray-700 leading-relaxed mb-8">
                    Our mission is to connect travelers with the best flight options worldwide. By leveraging
                    advanced technology, we simplify the booking process, ensuring a smooth and efficient travel experience.
                    Customer satisfaction is our priority, and we continuously improve our services to meet your needs.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-indigo-600 rounded-lg p-6 shadow-md border border-gray-100">
                        <h3 class="font-bold text-xl text-white mb-2">Global Connectivity</h3>
                        <p class="text-white">
                            We aim to connect people across the globe, offering affordable and flexible travel solutions.
                        </p>
                    </div>
                    <div class="bg-indigo-600 rounded-lg p-6 shadow-md border border-gray-100">
                        <h3 class="font-bold text-xl text-white mb-2">Innovative Technology</h3>
                        <p class="text-white">
                            Our platform uses the latest technology to provide a secure and seamless booking experience.
                        </p>
                    </div>
                    <div class="bg-indigo-600 rounded-lg p-6 shadow-md border border-gray-100">
                        <h3 class="font-bold text-xl text-white mb-2">Customer Focused</h3>
                        <p class="text-white">
                            We value customer feedback and continuously work to enhance our services to provide the best
                            possible experience.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Why Choose Us Section -->
            <section class="bg-white shadow-lg rounded-lg p-8 mb-12">
                <h2 class="text-3xl uppercase font-bold text-indigo-600 mb-4">Why Choose Us</h2>
                <ul class="list-disc pl-6 text-lg text-gray-700 space-y-3 mb-8">
                    <li>Easy-to-use booking platform with a user-friendly interface.</li>
                    <li>Access to a wide range of airlines and flight routes.</li>
                    <li>Secure payment options for a hassle-free transaction.</li>
                    <li>Real-time updates and notifications about your flight.</li>
                    <li>24/7 customer support to assist you at any time.</li>
                </ul>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-indigo-600 rounded-lg p-6 shadow-md border border-gray-100">
                        <h3 class="font-bold text-xl text-white mb-2">User Friendly</h3>
                        <p class="text-white">
                            Our platform is designed for ease of use, allowing you to book tickets in just a few clicks.
                        </p>
                    </div>
                    <div class="bg-indigo-600 rounded-lg p-6 shadow-md border border-gray-100">
                        <h3 class="font-bold text-xl text-white mb-2">Extensive Routes</h3>
                        <p class="text-white">
                            Choose from a wide selection of domestic and international flight routes for convenient travel.
                        </p>
                    </div>
                    <div class="bg-indigo-600 rounded-lg p-6 shadow-md border border-gray-100">
                        <h3 class="font-bold text-xl text-white mb-2">24/7 Customer Support</h3>
                        <p class="text-white">
                            Our support team is available 24/7 to help with bookings, inquiries, and any travel concerns.
                        </p>
                    </div>
                </div>
            </section>


            <!-- Gallery Section -->
            <section class="bg-gray-50 p-8">
                <h2 class="text-3xl font-bold text-indigo-600 mb-2 text-center uppercase">Explore Our Gallery</h2>
                <p class="text-center text-xl mb-4">This is our history</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-indigo-600 rounded-lg overflow-hidden shadow-lg">
                        <img src="https://i.pinimg.com/736x/14/30/f8/1430f87fa4fa7120416f446218a82154.jpg"
                            alt="Gallery Image 1" class="w-full h-64 object-cover grayscale">
                    </div>
                    <div class="bg-indigo-600 rounded-lg overflow-hidden shadow-lg">
                        <img src="https://i.pinimg.com/736x/c9/0d/4c/c90d4cc6758b51be6916ab36aafe43d5.jpg"
                            alt="Gallery Image 2" class="w-full h-64 object-cover grayscale">
                    </div>
                    <div class="bg-indigo-600 rounded-lg overflow-hidden shadow-lg">
                        <img src="https://i.pinimg.com/736x/2b/d7/b2/2bd7b227ea2d6cbc8f6640906e72ecdd.jpg"
                            alt="Gallery Image 3" class="w-full h-64 object-cover grayscale">
                    </div>
                    <div class="bg-indigo-600 rounded-lg overflow-hidden shadow-lg">
                        <img src="https://i.pinimg.com/736x/07/67/83/0767834cc8ac58ca83064aaeed786b85.jpg"
                            alt="Gallery Image 4" class="w-full h-64 object-cover grayscale">
                    </div>
                </div>
            </section>
        </div>
    @endsection
    @section('footer')
        @include('partials.footer')
    @endsection
</x-main-layout>
