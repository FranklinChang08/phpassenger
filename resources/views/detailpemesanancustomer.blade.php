<x-main-layout title="Profile">
    @section('header')
        @include('partials.navbar')
    @endsection
    @section('content')
        <section>
            <div class="w-full h-56 bg-gradient-to-l from-indigo-500 to-indigo-600 relative flex ">
                <div
                    class="absolute top-48 grid grid-cols-1 gap-0 space-y-2 px-2 w-full  lg:grid-cols-4 lg:gap-2 md:px-6 lg:px-12">
                    <div
                        class="bg-white h-fit shadow-lg rounded-md p-4 flex flex-col mt-2 justify-center items-center gap-6 lg:sticky lg:top-16">
                        <div class="profile text-center space-y-2">
                            <div
                                class="bg-gradient-to-r from-indigo-500 to-indigo-600 w-72 aspect-square rounded-full flex justify-center items-center">
                                <div class="bg-white m-1 rounded-full flex justify-center items-center">
                                    <img src="https://i.pinimg.com/736x/4c/85/31/4c8531dbc05c77cb7a5893297977ac89.jpg"
                                        alt="" class="p-1 rounded-full">
                                </div>
                            </div>
                            <div class="text">
                                <h1 class="font-bold text-xl text-indigo-600">{{ session('user')->nama }}</h1>
                                <p>{{ session('user')->email }}</p>
                            </div>
                        </div>
                        <ul class="space-y-4 w-full">
                            <li class="p-2 bg-gray-100 ">
                                <div class="flex justify-between items-center">
                                    <p class="font-medium">History Pemesanan</p>
                                    <p class="text-green-600 font-bold">{{ $pemesanan_count->count() }}</p>
                                </div>
                            </li>
                            <li class="p-2 bg-gray-100 ">
                                <div class="flex justify-between items-center">
                                    <p class="font-medium">Total Ticket Pemesanan</p>
                                    <p class="text-indigo-600 font-bold">{{ $detailpemesanan_count->count() }}</p>
                                </div>
                            </li>
                            <li class="p-2 bg-gray-100 ">
                                <div class="flex justify-between items-center">
                                    <p class="font-medium">Total Pembayaran</p>
                                    <p class="text-blue-600 font-bold">{{ $transaksi->count() }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white col-span-3 w-full shadow-lg space-y-4 rounded-md p-6 flex flex-col mb-24">
                        <div class="pemesanan p-12 bg-white shadow-lg rounded-lg space-y-4">
                            <h1 class="text-xl font-bold">Data Account Pemesan</h1>
                            <ul class="space-y-4">
                                <li>
                                    <h6 class="text-sm text-gray-600">Nama Pemesan</h6>
                                    <h2 class="bg-gray-100 p-2 rounded-md">{{ $pengguna->nama }}</h2>
                                </li>
                                <li>
                                    <h6 class="text-sm text-gray-600">Email Pemesan</h6>
                                    <h2 class="bg-gray-100 p-2 rounded-md">{{ $pengguna->email }}</h2>
                                </li>
                                <li>
                                    <h6 class="text-sm text-gray-600">Nomor Telepon Pemesan</h6>
                                    <h2 class="bg-gray-100 p-2 rounded-md">{{ $pengguna->nomor_telepon }}</h2>
                                </li>
                            </ul>
                        </div>
                        <div class="allcard ">
                            @foreach ($detailpemesanan as $item)
                                @php
                                    $totalMinutes = 0;
                                @endphp
                                <div
                                    class="card w-full shadow-lg rounded-md overflow-hidden flex flex-col items-center justify-center">
                                    <!-- Header Section -->
                                    <div
                                        class="headline w-full bg-gradient-to-r from-indigo-500 to-indigo-600 text-white p-4 flex justify-between items-center">
                                        <div>
                                            <h1 class="text-2xl font-bold">{{ $item->nama_penumpang }}</h1>
                                            <p class="text-sm">{{ $item->nomor_identitas }}</p>
                                        </div>
                                        <p class="text-md font-medium">
                                            {{ date('D, d M Y', strtotime($pemesanan->tanggal)) }}
                                        </p>
                                    </div>
                                    <!-- Description Section -->
                                    <div class="desc p-4 w-full bg-gray-50">
                                        <div class="rute flex items-center gap-6">
                                            <div class="flex flex-col items-center text-center">
                                                <div class="circle w-3 h-3 rounded-full shadow-md border-2 border-sky-500">
                                                </div>
                                                <p class="text-sm mt-2 text-gray-700">{{ $pemesanan->waktu_berangkat }}
                                                </p>
                                                <p class="text-sm font-medium text-gray-800">{{ $pemesanan->asal }}</p>
                                            </div>
                                            <div class="flex-1 relative">
                                                <div
                                                    class="line h-[2px] bg-gradient-to-r from-gray-300 via-gray-500 to-gray-300 w-full z-0">
                                                </div>
                                                @php
                                                    $start = \Carbon\Carbon::parse($pemesanan->waktu_berangkat);
                                                    $end = \Carbon\Carbon::parse($pemesanan->waktu_tiba);
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
                                                        class="dot absolute top-[-20px] left-1/2 transform -translate-x-1/2 text-sm font-semibold text-slate-700">
                                                        {{ $hours }}h {{ $minutes }}m
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex flex-col items-center text-center">
                                                <div
                                                    class="circle w-3 h-3 rounded-full shadow-md border-2 border-slate-700">
                                                </div>
                                                <p class="text-sm mt-2 text-gray-700">{{ $pemesanan->waktu_tiba }}</p>
                                                <p class="text-sm font-medium text-gray-800">{{ $pemesanan->tujuan }}</p>
                                            </div>
                                        </div>
                                        <div class="harga w-full p-2 flex justify-end items-center">                                           
                                            <h1 class="text-gray-500 font-semibold"><span
                                                    class="text-xl text-indigo-600">IDR
                                                    {{ number_format($item->harga_kursi, 2, ',', '.') }}</span>/Kursi</h1>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ url()->previous() }}" class="bg-indigo-600 rounded-lg text-white font-bold p-2 w-fit">Back</a>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</x-main-layout>
