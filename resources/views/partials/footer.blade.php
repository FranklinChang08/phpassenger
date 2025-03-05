<footer>
    <div class="w-full text-white bg-[#1A1A1D] flex flex-col divide-y">
        <div class="grid grid-cols-1 space-y-12 p-12 px-6 place-items-center place-content-center md:grid-cols-2 lg:grid-cols-4">
            <div class="left-footer w-full space-y-4 text-center flex justify-center items-center flex-col col-span-2 lg:col-span-1">
                <div class="icon">
                    <h1 class="uppercase font-bold text-4xl">Bus Ticket</h1>
                    <h5 class="text-indigo-600 uppercase font-semibold">Your Journey, Our Priority.</h5>
                </div>

            </div>
            <div class="middle-footer w-full col-span-2">
                <div class="space-y-2 flex flex-col justify-center items-center">
                    <ul class="flex justify-around w-full">
                        <li>
                            <a href="{{ route('home') }}"
                                class="relative font-poppins w-full inline-flex items-center justify-start p-2 text-white font-semibold rounded-sm overflow-hidden group focus:outline-none active:scale-95">
                                <span
                                    class="relative z-10 tracking-widest text-start font-semibold w-full group-hover:text-white group-hover:text-glow">Home</span>
                                <span
                                    class="absolute bottom-0 left-0 h-[2px] w-0 bg-white transition-all duration-300 ease-in-out group-hover:w-full"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pemesananForm') }}"
                                class="relative font-poppins w-full inline-flex items-center justify-start p-2 text-white font-semibold rounded-sm overflow-hidden group focus:outline-none active:scale-95">
                                <span
                                    class="relative z-10 tracking-widest text-start font-semibold w-full group-hover:text-white group-hover:text-glow">Ticket</span>
                                <span
                                    class="absolute bottom-0 left-0 h-[2px] w-0 bg-white transition-all duration-300 ease-in-out group-hover:w-full"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('aboutus') }}"
                                class="relative font-poppins w-full inline-flex items-center justify-start p-2 text-white font-semibold rounded-sm overflow-hidden group focus:outline-none active:scale-95">
                                <span
                                    class="relative z-10 tracking-widest text-start font-semibold w-full group-hover:text-white group-hover:text-glow">About Us</span>
                                <span
                                    class="absolute bottom-0 left-0 h-[2px] w-0 bg-white transition-all duration-300 ease-in-out group-hover:w-full"></span>
                            </a>
                        </li>
                    </ul>
                    <div class="desc w-full space-y-1">
                        <h1 class="uppercase text-gray-600 font-semibold text-center">About US</h1>
                        <p class="text-gray-600 text-sm w-full text-center">Platform terpercaya untuk pemesanan tiket
                            bus
                            online yang mudah, aman, dan nyaman. Jelajahi rute, pilih jadwal, dan nikmati perjalanan
                            tanpa ribet</p>
                    </div>
                </div>
            </div>
            <div class="right-footer flex justify-center items-center col-span-2 lg:col-span-1">
                <ul class="media-social flex gap-4">
                    <li>
                        <a href=""
                            class="relative font-poppins h-10 aspect-square inline-flex items-center justify-center p-2 text-white font-semibold rounded-full overflow-hidden group focus:outline-none active:scale-105">
                            <span
                                class="absolute inset-x-0 bottom-0 bg-indigo-600 transition-width duration-300 ease-in-out transform h-0 group-hover:h-full"></span>
                            <span class="relative z-10 tracking-widest font-light"><i
                                    class="fa-brands fa-facebook text-2xl text-white"></i></span>
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="relative font-poppins h-10 aspect-square inline-flex items-center justify-center p-2 text-white font-semibold rounded-full overflow-hidden group focus:outline-none active:scale-105">
                            <span
                                class="absolute inset-x-0 bottom-0 bg-indigo-600 transition-width duration-300 ease-in-out transform h-0 group-hover:h-full"></span>
                            <span class="relative z-10 tracking-widest font-light"><i
                                    class="fa-brands fa-instagram text-2xl text-white"></i></span>
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="relative font-poppins h-10 aspect-square inline-flex items-center justify-center p-2 text-white font-semibold rounded-full overflow-hidden group focus:outline-none active:scale-105">
                            <span
                                class="absolute inset-x-0 bottom-0 bg-indigo-600 transition-width duration-300 ease-in-out transform h-0 group-hover:h-full"></span>
                            <span class="relative z-10 tracking-widest font-light"><i
                                    class="fa-brands fa-x-twitter text-2xl text-white"></i></span>
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="relative font-poppins h-10 aspect-square inline-flex items-center justify-center p-2 text-white font-semibold rounded-full overflow-hidden group focus:outline-none active:scale-105">
                            <span
                                class="absolute inset-x-0 bottom-0 bg-indigo-600 transition-width duration-300 ease-in-out transform h-0 group-hover:h-full"></span>
                            <span class="relative z-10 tracking-widest font-light"><i
                                    class="fa-brands fa-tiktok text-2xl text-white"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="w-full">
            <div class="text-center p-6 w-full">
                <p class="text-gray-600">&copy; 2025 BusTicket. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
