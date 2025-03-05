<x-main-layout title="Pemesanan">
    @section('header')
        @include('partials.navbar')
    @endsection
    @section('content')
        <section id="hero" class="relative w-full h-screen">

            <img src="{{ asset('static/img/background.jpg') }}"
                class="w-full h-full object-cover absolute inset-0 "alt="Background Image">

            <div class="absolute inset-0 bg-black opacity-50 z-0"></div>
            <div
                class="absolute w-full bg-transparent left-0 p-2 inset-y-0 grid grid-cols-1 place-items-center text-center text-white md:grid-cols-2 md:w-3/4 md:text-start md:left-52">
                <div class="text flex flex-col gap-4 z-10">
                    <h1 class="text-lg font-bold uppercase text-indigo-600 md:text-xl">
                        PHPassenger</h1>
                    <h1 class="text-5xl font-semibold uppercase md:text-6xl">Welcome to Our Journey</h1>
                    <p class="text-md md:text-lg">Plan your journey with ease! Our plane ticketing platform offers a seamless
                        experience
                        to book your plane tickets online. Explore routes, compare schedules, and travel comfortably—all in
                        just a few clicks
                    </p>
                </div>
                <form action="{{ route('ticket') }}" method="GET"
                    class="p-6 hidden shadow-lg h-fit rounded-lg bg-white mx-auto text-black md:block">
                    <div class="mb-4">
                        <label for="asal" class="block text-sm font-medium text-gray-600 mb-1">
                            <i class="fa-solid fa-plane mr-2"></i> Depature
                        </label>
                        <input required type="text" id="asal" name="asal" placeholder="Enter depature location"
                            class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                    </div>

                    <div class="mb-4">
                        <label for="tujuan" class="block text-sm font-medium text-gray-600 mb-1">
                            <i class="fa-solid fa-location-dot mr-2"></i> Destination
                        </label>
                        <input required type="text" id="tujuan" name="tujuan" placeholder="Enter desctination"
                            class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                    </div>

                    <div class="mb-4 flex flex-wrap gap-4 items-end">
                        <div class="flex-1">
                            <label for="date" class="text-sm font-medium text-gray-600 mb-1 flex items-center gap-2">
                                <i class="fa-solid fa-calendar"></i> Date
                            </label>
                            <input required type="date" id="date" name="date" placeholder="Enter date"
                                class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                        </div>

                        <div class="flex gap-2">
                            <button type="button" onclick="setDate('today')"
                                class="relative bg-indigo-600 font-poppins w-fit inline-flex items-center justify-start p-2 drop-shadow-[5px_5px_10px_rgba(255,255,255,0.8)] text-white font-semibold rounded-md overflow-hidden group focus:outline-none active:scale-95">
                                <span
                                    class="absolute inset-y-0 left-0 bg-white transition-width duration-300 ease-in-out transform w-0 group-hover:w-full"></span>
                                <span
                                    class="relative z-10 font-bold text-md text-white transition-width duration-300 ease-in-out group-hover:text-indigo-600">Today</span>
                            </button>

                            <button type="button" onclick="setDate('tomorrow')"
                                class="relative bg-white border-2 border-indigo-600 font-poppins w-fit inline-flex items-center justify-start p-2 drop-shadow-[5px_5px_10px_rgba(255,255,255,0.8)] text-indigo-600 rounded-md overflow-hidden group focus:outline-none active:scale-95">
                                <span
                                    class="absolute inset-y-0 left-0 bg-indigo-600 transition-width duration-300 ease-in-out transform w-0 group-hover:w-full"></span>
                                <span
                                    class="relative z-10 font-semibold text-md text-indigo-600 transition-width duration-300 ease-in-out group-hover:text-white">Tomorrow</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            Buy Ticket
                        </button>
                        <a href="{{ route('ticket') }}"
                            class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            All Ticket
                        </a>
                    </div>
                </form>
            </div>
        </section>
        <section>
            <div class="w-full block p-4 md:hidden">
                <form action="{{ route('ticket') }}" method="GET"
                    class="p-6  shadow-lg h-fit rounded-lg bg-white mx-auto text-black">
                    <div class="mb-4">
                        <label for="asal" class="block text-sm font-medium text-gray-600 mb-1">
                            <i class="fa-solid fa-plane mr-2"></i> Depature
                        </label>
                        <input required type="text" id="asal" name="asal" placeholder="Enter depature location"
                            class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                    </div>

                    <div class="mb-4">
                        <label for="tujuan" class="block text-sm font-medium text-gray-600 mb-1">
                            <i class="fa-solid fa-location-dot mr-2"></i> Destination
                        </label>
                        <input required type="text" id="tujuan" name="tujuan" placeholder="Enter desctination"
                            class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                    </div>

                    <div class="mb-4 flex flex-wrap gap-4 items-end">
                        <div class="flex-1">
                            <label for="date" class="text-sm font-medium text-gray-600 mb-1 flex items-center gap-2">
                                <i class="fa-solid fa-calendar"></i> Date
                            </label>
                            <input required type="date" id="date" name="date" placeholder="Enter date"
                                class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                        </div>

                        <div class="flex gap-2">
                            <button type="button" onclick="setDate('today')"
                                class="relative bg-indigo-600 font-poppins w-fit inline-flex items-center justify-start p-2 drop-shadow-[5px_5px_10px_rgba(255,255,255,0.8)] text-white font-semibold rounded-md overflow-hidden group focus:outline-none active:scale-95">
                                <span
                                    class="absolute inset-y-0 left-0 bg-white transition-width duration-300 ease-in-out transform w-0 group-hover:w-full"></span>
                                <span
                                    class="relative z-10 font-bold text-md text-white transition-width duration-300 ease-in-out group-hover:text-indigo-600">Today</span>
                            </button>

                            <button type="button" onclick="setDate('tomorrow')"
                                class="relative bg-white border-2 border-indigo-600 font-poppins w-fit inline-flex items-center justify-start p-2 drop-shadow-[5px_5px_10px_rgba(255,255,255,0.8)] text-indigo-600 rounded-md overflow-hidden group focus:outline-none active:scale-95">
                                <span
                                    class="absolute inset-y-0 left-0 bg-indigo-600 transition-width duration-300 ease-in-out transform w-0 group-hover:w-full"></span>
                                <span
                                    class="relative z-10 font-semibold text-md text-indigo-600 transition-width duration-300 ease-in-out group-hover:text-white">Tomorrow</span>
                            </button>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="order_kursi" class="block text-sm font-medium text-gray-600 mb-1">
                            Order Chair
                        </label>
                        <input required type="text" id="order_kursi" name="order_kursi"
                            placeholder="Enter Order Chair"
                            class="w-full text-black px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            Buy Ticket
                        </button>
                        <a href="{{ route('ticket') }}"
                            class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            All Ticket
                        </a>
                    </div>
                </form>
            </div>
        </section>
    @endsection
    @section('footer')
        @include('partials.footer')
    @endsection
</x-main-layout>
