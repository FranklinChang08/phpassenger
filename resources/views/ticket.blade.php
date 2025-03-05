<x-main-layout title="Jadwal">
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

                    <a href="#ticket" aria-current="page"
                        class="relative bg-indigo-600 font-poppins w-fit inline-flex items-center justify-start p-2 drop-shadow-[5px_5px_10px_rgba(255,255,255,0.8)] text-white font-semibold rounded-md overflow-hidden group focus:outline-none active:scale-95">
                        <span
                            class="absolute inset-y-0 left-0 bg-white transition-width duration-300 ease-in-out transform w-0 group-hover:w-full"></span>
                        <span
                            class="relative z-10 tracking-widest font-bold text-md uppercase text-white transition-width duration-300 ease-in-out group-hover:text-indigo-600">See
                            Schedule</span>
                    </a>
                </div>
            </div>
        </section>

        <section class="ticket" id="ticket">
            <div class="w-full flex flex-col gap-4 p-6 lg:flex-row lg:p-12 lg:gap-12">
                <div class="jadwal-list w-full col-span-3 flex flex-col gap-4">
                    @if ($jadwal && $jadwal->count() > 0)
                        @foreach ($jadwal as $data_jadwal)
                            @php
                                $totalMinutes = 0;
                            @endphp
                            <a
                                href="{{ route('order', ['tanggal' => $data_jadwal->tanggal, 'id_kelas' => $data_jadwal->id_kelas, 'id_jadwal' => $data_jadwal->id_jadwal, 'total_kursi' => request('order_kursi')]) }}">
                                <div
                                    class="card w-full shadow-lg rounded-md overflow-hidden flex flex-col items-center justify-center transition duration-300 ease-in-out hover:scale-105">
                                    <div
                                        class="headline w-full bg-gradient-to-r from-indigo-500 to-indigo-600 text-white p-4 flex justify-between items-center">
                                        <div>
                                            <h1 class="text-2xl font-bold">{{ $data_jadwal->nama_maskapai }}</h1>
                                            <p class="text-sm opacity-80">{{ $data_jadwal->nama_kelas }}</p>
                                        </div>
                                        <div class="text-end">
                                            <p class="text-md font-medium">
                                                {{ date('D, d M Y', strtotime($data_jadwal->tanggal)) }}
                                            </p>
                                            <p>{{ $data_jadwal->nomor_penerbangan }}</p>
                                        </div>
                                    </div>
                                    <div class="desc p-4 w-full bg-gray-50">
                                        <div class="rute flex items-center gap-6">
                                            <div class="flex flex-col items-center text-center">
                                                <i class="fa-solid fa-plane-departure"></i>
                                                <p class="text-sm mt-2 text-gray-700">{{ $data_jadwal->waktu_berangkat }}
                                                </p>
                                                <p class="text-sm font-medium text-gray-800">{{ $data_jadwal->asal }}</p>
                                            </div>
                                            <div class="flex-1 relative">
                                                <div
                                                    class="line h-[2px] bg-gradient-to-r from-gray-300 via-gray-500 to-gray-300 w-full">
                                                </div>
                                                @php
                                                    $start = \Carbon\Carbon::parse($data_jadwal->waktu_berangkat);
                                                    $end = \Carbon\Carbon::parse($data_jadwal->waktu_tiba);
                                                    $totalMinutes += $end->diffInMinutes($start, true);
                                                    $hours = floor($totalMinutes / 60);
                                                    $minutes = $totalMinutes % 60;
                                                @endphp
                                                @if ($minutes == 0)
                                                    <div
                                                        class="dot absolute top-[-20px] left-1/2 transform -translate-x-1/2 text-sm font-semibold text-slate-700">
                                                        {{ $hours }}h
                                                    </div>
                                                @else
                                                    <div
                                                        class="dot absolute top-[-20px] left-1/2 transform text-nowrap -translate-x-1/2 text-sm font-semibold text-slate-700">
                                                        {{ $hours }}h {{ $minutes }}m
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex flex-col items-center text-center">
                                                <i class="fa-solid fa-plane-arrival"></i>
                                                <p class="text-sm mt-2 text-gray-700">{{ $data_jadwal->waktu_tiba }}</p>
                                                <p class="text-sm font-medium text-gray-800">{{ $data_jadwal->tujuan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="harga w-full p-2 flex justify-end items-center">
                                        <h1 class="text-gray-500 font-semibold"><span class="text-xl text-indigo-600">IDR
                                                {{ number_format($data_jadwal->harga, 2, ',', '.') }}</span>/Kursi</h1>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="flex items-center p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
                            <svg class="w-5 h-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.366-.74 1.43-.74 1.796 0l6.348 12.857c.334.675-.126 1.443-.898 1.443H2.807c-.772 0-1.232-.768-.898-1.443L8.257 3.1zM9 13a1 1 0 112 0 1 1 0 01-2 0zm.25-4.75a.75.75 0 10-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium mr-2">Warning:</span>Mohon Maaf jadwal yang anda cari tidak tersedia.
                        </div>
                    @endif
                </div>

                <div class="filtering w-full relative">
                    <form action="" method="GET" class="p-6 shadow-lg rounded-lg bg-white mx-auto sticky top-20">

                        <div class="mb-4">
                            <label for="asal" class="block text-sm font-medium text-gray-600 mb-1">
                                <i class="fa-solid fa-plane-departure mr-2"></i> Departure
                            </label>
                            <input type="text" id="asal" name="asal" placeholder="Enter depature location"
                                value="{{ request('asal') }}"
                                class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                        </div>

                        <div class="mb-4">
                            <label for="tujuan" class="block text-sm font-medium text-gray-600 mb-1">
                                <i class="fa-solid fa-plane-arrival mr-2"></i> Destination
                            </label>
                            <input type="text" id="tujuan" name="tujuan" placeholder="Enter desctination"
                                value="{{ request('tujuan') }}"
                                class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                        </div>

                        <div class="mb-4 flex flex-wrap gap-4 items-end">
                            <div class="flex-1">
                                <label for="date"
                                    class="text-sm font-medium text-gray-600 mb-1 flex items-center gap-2">
                                    <i class="fa-solid fa-calendar"></i> Date
                                </label>
                                <input type="date" id="date" name="date" placeholder="Enter date"
                                    value="{{ request('date') }}"
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

                        <div class="flex justify-end">
                            <input type="hidden" name="order_kursi" value="{{ request('order_kursi') }}"
                                class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                            <button type="submit"
                                class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @endsection
    @section('footer')
        @include('partials.footer')
    @endsection
</x-main-layout>
