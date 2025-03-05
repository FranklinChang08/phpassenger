<nav class="fixed top-0 left-0 z-50">
    <div class="w-24 h-screen bg-white shadow-lg overflow-y-scroll no-scrollbar">
        <div class="w-full">
            <div class="icon">
                <img className="w-6 aspect-square rounded-md shadow-lg" src="{{ asset('static/img/icon.jpg') }}"
                    alt="Icon" />
            </div>

            <ul class="Link w-full flex flex-col justify-center items-center mt-10 gap-1">
                <li class="w-full p-2">
                    <a href="{{ route('dashboard') }}"
                        class="aspect-square w-full rounded-lg flex justify-center items-center hover:bg-gray-300">
                        <i class="fa-solid fa-grip-vertical text-2xl"></i>
                    </a>
                </li>
                <li class="w-full p-2">
                    <a href="{{ route('pengguna.index') }}"
                        class=" aspect-square w-full rounded-lg flex justify-center items-center hover:bg-gray-300">
                        <i class="fa-solid fa-users text-2xl"></i>
                    </a>
                </li>
                <li class="w-full p-2">
                    <a href="{{ route('kelas.index') }}"
                        class="aspect-square w-full rounded-lg flex justify-center items-center hover:bg-gray-300">
                        <i class="fa-solid fa-list text-2xl"></i>
                    </a>
                </li>
                <li class="w-full p-2">
                    <a href="{{ route('harga.index') }}"
                        class="aspect-square w-full rounded-lg flex justify-center items-center hover:bg-gray-300">
                        <i class="fa-solid fa-money-bill-wave text-2xl"></i>
                    </a>
                </li>
                <li class="w-full p-2">
                    <a href="{{ route('plane.index') }}"
                        class=" aspect-square w-full rounded-lg flex justify-center items-center hover:bg-gray-300">
                        <i class="fa-solid fa-plane text-2xl"></i>
                    </a>
                </li>
                <li class="w-full p-2">
                    <a href="{{ route('rute.index') }}"
                        class=" aspect-square w-full rounded-lg flex justify-center items-center hover:bg-gray-300">
                        <i class="fa-solid fa-route text-2xl"></i>
                    </a>
                </li>
                <li class="w-full p-2">
                    <a href="{{ route('planerute.index') }}"
                        class=" aspect-square w-full rounded-lg flex justify-center items-center hover:bg-gray-300">
                        <i class="fa-solid fa-plane text-2xl"></i>
                        <i class="fa-solid fa-route text-2xl"></i>
                    </a>
                </li>
                <li class="w-full p-2">
                    <a href="{{ route('jadwal.index') }}"
                        class=" aspect-square w-full rounded-lg flex justify-center items-center hover:bg-gray-300">
                        <i class="fa-solid fa-calendar text-2xl"></i>
                    </a>
                </li>
                <li class="w-full p-2">
                    <a href="{{ route('kursiplane.index') }}"
                        class=" aspect-square w-full rounded-lg flex justify-center items-center hover:bg-gray-300">
                        <i class="fa-solid fa-chair text-2xl"></i>
                    </a>
                </li>
                <li class="w-full p-2">
                    <a href="{{ route('pemesanan.index') }}"
                        class=" aspect-square w-full rounded-lg flex justify-center items-center hover:bg-gray-300">
                        <i class="fa-regular fa-address-book text-2xl"></i>
                    </a>
                </li>
                <li class="w-full p-2">
                    <a href="{{ route('transaction.index') }}"
                        class=" aspect-square w-full rounded-lg flex justify-center items-center hover:bg-gray-300">
                        <i class="fa-solid fa-credit-card text-2xl"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
