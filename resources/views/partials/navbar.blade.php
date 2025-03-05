<nav class="fixed w-full top-0 left-0 backdrop-blur-lg bg-white z-50 shadow-md">
    <div class="container mx-auto flex items-center justify-between px-6 py-2">
        <!-- Logo and Hamburger Menu -->
        <div class="flex items-center justify-between w-full md:w-auto">
            <img class="w-8 aspect-square rounded-lg shadow-lg" src="{{ asset('static/img/icon.jpg') }}" alt="Logo">
            <button id="hamburgerIcon" class="md:hidden text-indigo-600 text-xl">
                <i class="fas fa-bars"></i>

            </button>
        </div>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex items-center space-x-6">
            <li>
                <a href="{{ route('home') }}"
                    class="relative font-poppins w-full inline-flex items-center justify-start p-2 text-indigo-600 font-semibold rounded-sm overflow-hidden group focus:outline-none active:scale-95">
                    <span
                        class="relative z-10 uppercase tracking-widest text-center font-semibold w-full group-hover:text-indigo-600 group-hover:text-glow">Home</span>
                    <span
                        class="absolute bottom-0 left-0 h-[2px] w-0 bg-indigo-600 transition-all duration-300 ease-in-out group-hover:w-full"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('pemesananForm') }}"
                    class="relative font-poppins w-full inline-flex items-center justify-start p-2 text-indigo-600 font-semibold rounded-sm overflow-hidden group focus:outline-none active:scale-95">
                    <span
                        class="relative z-10 uppercase tracking-widest text-center font-semibold w-full group-hover:text-indigo-600 group-hover:text-glow">Ticket</span>
                    <span
                        class="absolute bottom-0 left-0 h-[2px] w-0 bg-indigo-600 transition-all duration-300 ease-in-out group-hover:w-full"></span>
                </a>
            </li>
            <li>
                <a href="{{ route('aboutus') }}"
                    class="relative font-poppins w-full inline-flex items-center justify-start p-2 text-indigo-600 font-semibold rounded-sm overflow-hidden group focus:outline-none active:scale-95">
                    <span
                        class="relative z-10 uppercase tracking-widest text-center font-semibold w-full group-hover:text-indigo-600 group-hover:text-glow">About
                        Us</span>
                    <span
                        class="absolute bottom-0 left-0 h-[2px] w-0 bg-indigo-600 transition-all duration-300 ease-in-out group-hover:w-full"></span>
                </a>
            </li>

            @guest
                <li><a href="{{ route('login') }}"
                        class="block text-indigo-600 py-2 transition-all duration-500 ease-in-out">Login</a></li>
                <li><a href="{{ route('register') }}"
                        class="block text-indigo-600 py-2 transition-all duration-500 ease-in-out">Register</a></li>
            @endguest
            @auth
                <li>
                    <a href="{{ route('profile', session('user')->id_pengguna) }}#History"
                        class="relative font-poppins w-full inline-flex items-center justify-start p-2 text-indigo-600 font-semibold rounded-sm overflow-hidden group focus:outline-none active:scale-95">
                        <span
                            class="relative z-10 uppercase tracking-widest text-center font-semibold w-full group-hover:text-indigo-600 group-hover:text-glow">History
                            Order</span>
                        <span
                            class="absolute bottom-0 left-0 h-[2px] w-0 bg-indigo-600 transition-all duration-300 ease-in-out group-hover:w-full"></span>
                    </a>
                </li>
                <li class="relative">
                    <button id="profileDropdownToggle"
                        class="flex items-center relative space-x-2 text-indigo-600 py-2 transition-all duration-500 ease-in-out">
                        <i class="fas fa-user text-xl"></i>
                        @if ($transaction_notif && $transaction_notif->count() > 0)
                            <span
                                class="bg-red-600 absolute top-2 left-2 w-1.5 rounded-full aspect-square text-white"></span>
                        @endif
                    </button>
                    <!-- Dropdown Menu -->
                    <ul id="profileDropdownMenu"
                        class="absolute right-0 shadow-lg mt-2 space-y-2 bg-white  rounded-md hidden min-w-[150px] text-sm text-gray-800 p-2">
                        <li>
                            <a href="{{ route('profile', session('user')->id_pengguna) }}"
                                class="block px-4 py-2 hover:bg-orange-100 rounded-md hover:text-indigo-600 transition-all duration-300">My
                                Profile</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 hover:bg-orange-100 rounded-md hover:text-indigo-600 transition-all duration-300">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endauth
        </ul>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="absolute top-full left-0 w-full hidden md:hidden bg-white shadow-md p-4">
            <ul class="space-y-4">
                <li><a href="{{ route('home') }}"
                        class="block px-4 py-2 hover:bg-orange-100 rounded-md hover:text-indigo-600 transition-all duration-300">Home</a>
                </li>
                <li><a href="{{ route('pemesananForm') }}"
                        class="block px-4 py-2 hover:bg-orange-100 rounded-md hover:text-indigo-600 transition-all duration-300">Ticket</a>
                </li>
                <li><a href="{{ route('aboutus') }}"
                        class="block px-4 py-2 hover:bg-orange-100 rounded-md hover:text-indigo-600 transition-all duration-300">About
                        Us</a></li>
                @guest
                    <li><a href="{{ route('login') }}"
                            class="block px-4 py-2 hover:bg-orange-100 rounded-md hover:text-indigo-600 transition-all duration-300">Login</a>
                    </li>
                    <li><a href="{{ route('register') }}"
                            class="block px-4 py-2 hover:bg-orange-100 rounded-md hover:text-indigo-600 transition-all duration-300">Register</a>
                    </li>
                @endguest
                @auth
                    <li><a href="{{ route('profile', session('user')->id_pengguna) }}"
                            class="block px-4 py-2 hover:bg-orange-100 rounded-md hover:text-indigo-600 transition-all duration-300">My
                            Profile</a>
                    </li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block px-4 w-full text-start py-2 hover:bg-orange-100 rounded-md hover:text-indigo-600 transition-all duration-300">Logout</button>
                    </form>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<script>
    document.getElementById('hamburgerIcon').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
        mobileMenu.classList.toggle('animate__fadeIn');
    });
</script>
<script>
    const profileDropdownToggle = document.getElementById('profileDropdownToggle');
    const profileDropdownMenu = document.getElementById('profileDropdownMenu');

    profileDropdownToggle.addEventListener('click', () => {
        profileDropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (event) => {
        if (!profileDropdownToggle.contains(event.target) &&
            !profileDropdownMenu.contains(event.target)) {
            profileDropdownMenu.classList.add('hidden');
        }
    });
</script>

<style>
    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .animate__fadeIn {
        animation: fadeIn 0.5s ease-in-out;
    }
</style>
