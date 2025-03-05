<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-tr from-orange-500 from-10% via-30% via-orange-600 to-90% to-orange-700 text-white flex items-center justify-center h-screen">
    <header>
        <nav>
            <nav class="fixed w-full top-0 left-0 backdrop-blur-lg bg-transparent z-50">
                <div class="container mx-auto flex items-center justify-between px-6 py-2">
                    <!-- Logo and Hamburger Menu -->
                    <div class="flex items-center justify-between w-full md:w-auto">
                        <img class="w-8 aspect-square rounded-lg shadow-lg" src="{{ asset('static/img/icon.jpg') }}"
                            alt="Logo">
                        <button id="hamburgerIcon" class="md:hidden text-white text-xl">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>

                    <!-- Desktop Menu -->
                    <ul class="hidden md:flex items-center space-x-6">
                        <li>
                            <a href="{{ route('home') }}"
                                class="relative font-poppins w-full inline-flex items-center justify-start p-2 text-white font-semibold rounded-sm overflow-hidden group focus:outline-none active:scale-95">
                                <span
                                    class="relative z-10 uppercase tracking-widest text-center font-semibold w-full group-hover:text-white group-hover:text-glow">Home</span>
                                <span
                                    class="absolute bottom-0 left-0 h-[2px] w-0 bg-white transition-all duration-300 ease-in-out group-hover:w-full"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pemesananForm') }}"
                                class="relative font-poppins w-full inline-flex items-center justify-start p-2 text-white font-semibold rounded-sm overflow-hidden group focus:outline-none active:scale-95">
                                <span
                                    class="relative z-10 uppercase tracking-widest text-center font-semibold w-full group-hover:text-white group-hover:text-glow">Ticket</span>
                                <span
                                    class="absolute bottom-0 left-0 h-[2px] w-0 bg-white transition-all duration-300 ease-in-out group-hover:w-full"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('aboutus') }}"
                                class="relative font-poppins w-full inline-flex items-center justify-start p-2 text-white font-semibold rounded-sm overflow-hidden group focus:outline-none active:scale-95">
                                <span
                                    class="relative z-10 uppercase tracking-widest text-center font-semibold w-full group-hover:text-white group-hover:text-glow">About
                                    Us</span>
                                <span
                                    class="absolute bottom-0 left-0 h-[2px] w-0 bg-white transition-all duration-300 ease-in-out group-hover:w-full"></span>
                            </a>
                        </li>
                    </ul>

                    <!-- Mobile Menu -->
                    <div id="mobileMenu"
                        class="absolute top-full left-0 w-full hidden md:hidden bg-white shadow-md p-4">
                        <ul class="space-y-4">
                            <li><a href="{{ route('home') }}"
                                    class="block px-4 py-2 hover:bg-orange-100 rounded-md hover:text-white transition-all duration-300">Home</a>
                            </li>
                            <li><a href="{{ route('pemesananForm') }}"
                                    class="block px-4 py-2 hover:bg-orange-100 rounded-md hover:text-white transition-all duration-300">Ticket</a>
                            </li>
                            <li><a href="{{ route('aboutus') }}"
                                    class="block px-4 py-2 hover:bg-orange-100 rounded-md hover:text-white transition-all duration-300">About
                                    Us</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </nav>
    </header>
    <main>
        <div class="text-center">
            <h1 class="text-[10rem] font-extrabold text-white/80 drop-shadow-lg">
                404
            </h1>
            <p class="text-lg mt-4 mb-8 font-bold">
                Oops! The page you're looking for doesn't exist.
            </p>
            <a href="{{ route('home') }}"
                class="relative bg-transparent font-poppins w-full inline-flex items-center justify-center p-2 text-white font-semibold rounded-md overflow-hidden group focus:outline-none active:scale-95">
                <span
                    class="absolute inset-y-0 left-0 bg-white transition-width duration-300 ease-in-out transform w-0 group-hover:w-full"></span>
                <span
                    class="relative z-10 tracking-widest underline decoration-2 underline-offset-8 font-bold text-md uppercase text-white transition-width duration-300 ease-in-out group-hover:no-underline group-hover:text-orange-600">Go Back Home</span>
            </a>
        </div>
    </main>
</body>

</html>
