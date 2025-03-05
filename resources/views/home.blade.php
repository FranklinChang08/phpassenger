<x-main-layout title="Home">
    @section('header')
        @include('partials.navbar')
    @endsection
    @section('content')
        <section id="hero" class="relative w-full h-screen">
            <img src="{{ asset('static/img/background.jpg') }}"
                class="w-full h-full object-cover absolute inset-0 "alt="Background Image">

            <div class="absolute inset-0 bg-black opacity-50 z-0"></div>
            <div
                class="absolute w-full bg-transparent left-0 p-2 inset-y-0 flex items-center justify-center text-center text-white md:text-start md:left-12 md:w-3/4">
                <div class="text flex flex-col gap-4 z-10  items-center justify-center md:items-start">
                    <h1 class="text-lg font-bold uppercase text-indigo-600 md:text-xl">
                        PHPassenger</h1>
                    <h1 class="text-5xl font-semibold uppercase md:text-6xl">Welcome to Our Journey</h1>
                    <p class="text-md md:text-lg">Plan your journey with ease! Our flight ticketing platform offers a seamless
                        experience
                        to book your bus tickets online. Explore routes, compare schedules, and travel comfortably—all in
                        just a few clicks
                    </p>

                    <a href="{{ route('pemesananForm') }}"
                        class="relative bg-indigo-600 font-poppins w-fit inline-flex items-center justify-start p-2 drop-shadow-[5px_5px_10px_rgba(255,255,255,0.8)] text-white font-semibold rounded-md overflow-hidden group focus:outline-none active:scale-95">
                        <span
                            class="absolute inset-y-0 left-0 bg-white transition-width duration-300 ease-in-out transform w-0 group-hover:w-full"></span>
                        <span
                            class="relative z-10 tracking-widest font-bold text-md uppercase text-white transition-width duration-300 ease-in-out group-hover:text-indigo-600">Order
                            Now</span>
                    </a>
                </div>
            </div>
        </section>
        <section id="category">

            <ul class="flex flex-wrap p-12 gap-6 justify-center items-center w-full">
                <li class="bg-gray-700/20 px-4 py-1 rounded-full hover:bg-gray-700/30 border border-gray-700/30">Traveller
                </li>
                <li class="bg-gray-700/20 px-4 py-1 rounded-full hover:bg-gray-700/30 border border-gray-700/30">Holiday
                </li>
                <li class="bg-gray-700/20 px-4 py-1 rounded-full hover:bg-gray-700/30 border border-gray-700/30">Vacation
                </li>
                <li class="bg-gray-700/20 px-4 py-1 rounded-full hover:bg-gray-700/30 border border-gray-700/30">Family Trip
                </li>
                <li class="bg-gray-700/20 px-4 py-1 rounded-full hover:bg-gray-700/30 border border-gray-700/30">Adventure
                </li>
                <li class="bg-gray-700/20 px-4 py-1 rounded-full hover:bg-gray-700/30 border border-gray-700/30">Tourist
                </li>
                <li class="bg-gray-700/20 px-4 py-1 rounded-full hover:bg-gray-700/30 border border-gray-700/30">Group
                    Travel
                </li>
            </ul>
        </section>
        <section class="desc">
            <div class="allcard p-6 gap-6 flex flex-col justify-center items-center lg:p-12 ">
                <div class="card w-full flex gap-4 p-4 shadow-lg rounded-md flex-col lg:flex-row lg:w-3/4">
                    <img src="https://i.pinimg.com/736x/77/b4/21/77b421686d6088e6527cf57d68c69e96.jpg" alt=""
                        class="h-56 object-cover">
                    <div class="desc space-y-4">
                        <h1 class="uppercase text-xl font-semibold">Your Trusted Travel Companion</h1>
                        <p>We envision a world where traveling is simple, reliable, and accessible for everyone. Our goal is
                            to become your trusted companion in every journey, providing a seamless bus ticketing experience
                            that connects you to the best operators. Whether you're commuting to work, exploring new
                            destinations, or reuniting with loved ones, we ensure your travel is safe, comfortable, and
                            affordable. Let us help you create unforgettable memories with every trip.</p>
                    </div>
                </div>
                <div class="card w-full flex gap-4 p-4 shadow-lg rounded-md flex-col lg:flex-row lg:p-12 lg:w-3/4">
                    <div class="desc space-y-4 text-end">
                        <h1 class="uppercase text-xl font-semibold">Simplifying Your Travel</h1>
                        <p>Our mission is to revolutionize the way people travel by simplifying every step of the process.
                            Through our user-friendly platform, we aim to provide a wide range of reliable schedules,
                            flexible options, and secure bookings tailored to your needs. We strive to deliver a stress-free
                            experience, connecting you to trusted bus operators while prioritizing your convenience and
                            comfort. Whether it's for business, leisure, or adventure, we are committed to making your
                            travel plans effortless and enjoyable.</p>
                    </div>
                    <img src="https://i.pinimg.com/736x/34/9d/45/349d45d4bb3e76c72a4475b9163de5cc.jpg" alt=""
                        class="h-56 object-cover">
                </div>
            </div>
        </section>
        <div class="location-destination">
            <div
                class="scroll-container-destination w-full flex items-center gap-6 px-6 overflow-x-scroll whitespace-nowrap no-scrollbar">
                <img class="w-52 aspect-square object-cover rounded-md"
                    src="{{ asset('https://i.pinimg.com/736x/65/c4/a5/65c4a58b427da38f5d14b6c13f93e26f.jpg') }}"
                    alt="">
                <img class="w-52 aspect-square object-cover rounded-md"
                    src="{{ asset('https://i.pinimg.com/736x/7f/90/cf/7f90cf3b56eb86f5ad811bbe7a077522.jpg') }}"
                    alt="">
                <img class="w-52 aspect-square object-cover rounded-md"
                    src="{{ asset('https://i.pinimg.com/736x/a3/f7/68/a3f7682038e55a2edc540ec1f57ca978.jpg') }}"
                    alt="">
                <img class="w-52 aspect-square object-cover rounded-md"
                    src="{{ asset('https://i.pinimg.com/736x/fa/95/9e/fa959e3e9ab1d73435bbd1685c70c8bc.jpg') }}"
                    alt="">
                <img class="w-52 aspect-square object-cover rounded-md"
                    src="{{ asset('https://i.pinimg.com/736x/b1/ea/4d/b1ea4d032544fdb42dbf6b737eca0596.jpg') }}"
                    alt="">
                <img class="w-52 aspect-square object-cover rounded-md"
                    src="{{ asset('https://i.pinimg.com/736x/e8/16/67/e816675ef7580f2088619f48dd9420f3.jpg') }}"
                    alt="">
                <img class="w-52 aspect-square object-cover rounded-md"
                    src="{{ asset('https://i.pinimg.com/736x/c3/33/f5/c333f5fe17d0cfa3da57f5a95e9af5ac.jpg') }}"
                    alt="">

            </div>
        </div>
        <section class="whychooseus bg-gray-100 py-16">
            <div class="container mx-auto space-y-4 px-6 text-center hidden md:block">
                <div class="header mb-12">
                    <h1 class="text-5xl font-bold text-indigo-600">Why Choose PHPassenger?</h1>
                    <p class="text-xl text-gray-700 mt-4">We are committed to delivering exceptional service to make your
                        travel experience smooth, safe, and enjoyable. Here are several compelling reasons why customers
                        trust our flight ticketing platform:</p>
                </div>

                <div class="card grid grid-cols-1 justify-center items-center gap-12 md:grid-cols-2">
                    <div class="text-start">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Seamless Booking Experience</h2>
                        <p class="text-gray-600 text-lg mb-6">
                            Booking your flight ticket is fast and easy with our user-friendly platform. Whether for
                            business or leisure, find the perfect flight in just a few clicks with 24/7 access, eliminating
                            long queues and office hour constraints. Our secure payment system ensures your personal and
                            financial information is always protected.
                        </p>
                    </div>
                    <div class="card flex justify-center items-center">
                        <img src="https://i.pinimg.com/736x/5d/20/2a/5d202a2ec52324d5478647755a4b2121.jpg"
                            alt="Flight Ticketing" class="rounded-lg  max-w-md shadow-lg">
                    </div>
                </div>

                <div class=" grid grid-cols-1 justify-center items-center gap-12 md:grid-cols-2">
                    <div class="card w-full flex items-center justify-center">
                        <img src="https://i.pinimg.com/736x/9e/ca/5a/9eca5add40b49f2778c9901edc264087.jpg"
                            alt="Flight Ticketing" class="rounded-lg max-w-md shadow-lg">
                    </div>
                    <div class="card text-end">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Wide Selection of Destinations</h2>
                        <p class="text-gray-600 text-lg mb-6">
                            Choose from a vast range of domestic and international flight routes that fit your schedule and
                            travel plans. Enjoy flexible options, whether you prefer direct flights or layovers at exciting
                            locations.
                        </p>
                    </div>
                </div>

                <div class="card  grid grid-cols-1 justify-center items-center gap-12 md:grid-cols-2">
                    <div class="desc text-start">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Real-Time Flight Tracking & Updates</h2>
                        <p class="text-gray-600 text-lg mb-6">
                            Stay informed with real-time flight tracking and instant notifications on any changes, including
                            alerts on delays and arrival updates to ensure a smooth travel experience.
                        </p>
                    </div>
                    <div class="card flex  justify-center items-center">
                        <img src="https://i.pinimg.com/736x/6f/2f/fc/6f2ffc2c5a47b949b114577380c5bd4a.jpg"
                            alt="Flight Ticketing" class="rounded-lg max-w-md shadow-lg">
                    </div>
                </div>

            </div>
        </section>


        <section class="sponsor">
            <div class="allcard flex gap-4 py-3">
                <div
                    class="scroll-container-sponsor w-full flex items-center gap-6 px-6 overflow-x-scroll whitespace-nowrap no-scrollbar">
                    <img class="w-40 aspect-square object-contain" src="{{ asset('static/img/sponsor/paypal.png') }}"
                        alt="">
                    <img class="w-40 aspect-square object-contain" src="{{ asset('static/img/sponsor/gopay.png') }}"
                        alt="">
                    <img class="w-40 aspect-square object-contain" src="{{ asset('static/img/sponsor/Ovo.jpg') }}"
                        alt="">
                    <img class="w-40 aspect-square object-contain" src="{{ asset('static/img/sponsor/sp.png') }}"
                        alt="">
                    <img class="w-40 aspect-square object-contain" src="{{ asset('static/img/sponsor/bca.png') }}"
                        alt="">
                    <img class="w-40 aspect-square object-contain" src="{{ asset('static/img/sponsor/mandiri.png') }}"
                        alt="">
                    <img class="w-40 aspect-square object-contain" src="{{ asset('static/img/sponsor/bni.png') }}"
                        alt="">
                    <img class="w-40 aspect-square object-contain" src="{{ asset('static/img/sponsor/ocbc.png') }}"
                        alt="">
                </div>
            </div>
        </section>
        <script>
            function setupLoopScroll(containerSelector, scrollSpeed = 1) {
                const container = document.querySelector(containerSelector);

                if (!container) {
                    console.warn(`Container with selector "${containerSelector}" not found.`);
                    return;
                }

                container.innerHTML += container.innerHTML;

                let scrollPosition = 0;

                function loopScroll() {
                    scrollPosition += scrollSpeed;

                    if (scrollPosition >= container.scrollWidth / 2) {
                        scrollPosition = 0;
                    }

                    container.scrollLeft = scrollPosition;

                    requestAnimationFrame(loopScroll);
                }

                loopScroll();
            }

            setupLoopScroll('.scroll-container-destination', 1); // First container
            setupLoopScroll('.scroll-container-sponsor', 1); // Another container with different speed
        </script>
    @endsection
    @section('footer')
        @include('partials.footer')
    @endsection
</x-main-layout>
