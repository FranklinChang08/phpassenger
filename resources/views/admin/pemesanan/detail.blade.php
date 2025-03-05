<x-admin-layout>
    <div class="pemesananList mb-6">
        <div
            class="nav sticky top-0 right-0 bg-white p-4 rounded-lg mr-4 mt-4 shadow-md flex justify-between items-center z-10">
            <h1 class="text-gray-800 font-bold">Detail Pemesanan List</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                    Logout
                </button>
            </form>
        </div>
        <div class="allcard grid grid-cols-2 gap-4">
            <div class="flex flex-col gap-4 mt-4">
                @if ($detailpemesanan && $detailpemesanan->count() > 0)
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
                                        <div class="circle w-3 h-3 rounded-full shadow-md border-2 border-slate-700">
                                        </div>
                                        <p class="text-sm mt-2 text-gray-700">{{ $pemesanan->waktu_tiba }}</p>
                                        <p class="text-sm font-medium text-gray-800">{{ $pemesanan->tujuan }}</p>
                                    </div>
                                </div>
                                <div class="harga w-full p-2 flex justify-between items-center">
                                    <div class="button flex gap-4">
                                        <a href="{{ route('detailpemesanan.edit', $item->id_detail_pemesanan) }}"
                                            class="text-yellow-500 font-semibold">Edit</a>
                                        <form
                                            action="{{ route('detailpemesanan.destroy', $item->id_detail_pemesanan) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id_pemesanan"
                                                value="{{ $item->id_pemesanan }}">
                                            <button type="submit" class="text-red-600 font-semibold">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                    <h1 class="text-gray-500 font-semibold"><span class="text-xl text-indigo-600">IDR
                                            {{ number_format($item->harga_kursi, 2, ',', '.') }}</span>/Kursi</h1>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <a href="{{ route('detailpemesanan.addnew', ['id_pemesanan' => $item->id_pemesanan, 'id_kelas' => $item->id_kelas, 'tanggal' => $pemesanan->tanggal]) }}"
                        class="bg-indigo-600 w-fit h-fit flex text-center p-4 rounded-md shadow-md text-white"><i
                            class="fa-solid fa-plus"></i></a>
                @else
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
                        <svg class="w-5 h-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.366-.74 1.43-.74 1.796 0l6.348 12.857c.334.675-.126 1.443-.898 1.443H2.807c-.772 0-1.232-.768-.898-1.443L8.257 3.1zM9 13a1 1 0 112 0 1 1 0 01-2 0zm.25-4.75a.75.75 0 10-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium mr-2">Warning:</span>Data Bus Rute tidak tersedia.
                    </div>
                @endif
            </div>
            @if ($detailpemesanan && $detailpemesanan->count() > 0)
                <div class="filtering w-full relative overflow-hidden p-4 space-y-4">
                    <div class="total p-6 flex justify-between items-center shadow-lg rounded-lg bg-white mx-auto">
                        <p>Total</p>
                        <p class="font-semibold text-xl text-indigo-600">IDR
                            {{ number_format($item->total_harga, 2, ',', '.') }}</p>
                    </div>
                    <form action="" method="GET" class="p-6 shadow-lg rounded-lg bg-white mx-auto">
                        <h1 class="text-center mb-4 font-medium uppercase">Search Ticket Order</h1>
                        @csrf
                        @method('GET')

                        <div class="mb-4">
                            <label for="nama_penumpang" class="block text-sm font-medium text-gray-600 mb-1">
                                <i class="fa-solid fa-user mr-2"></i> Name
                            </label>
                            <input type="text" id="nama_penumpang" name="nama_penumpang"
                                placeholder="Enter Name location" value="{{ request('nama_penumpang') }}"
                                class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                        </div>

                        <div class="mb-4">
                            <label for="nomor_identitas" class="block text-sm font-medium text-gray-600 mb-1">
                                <i class="fa-solid fa-id-card mr-2"></i> Number Identity
                            </label>
                            <input type="text" id="nomor_identitas" name="nomor_identitas"
                                placeholder="Enter Number Identity" value="{{ request('nomor_identitas') }}"
                                class="w-full px-4 py-2 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                        </div>

                        <div class="flex justify-between items-center">
                            <a href="{{ route('pemesanan.index') }}"
                                class="w-fit font-bold px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                                Back
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <a href="{{ route('pemesanan.index') }}"
                    class="w-fit h-fit mt-4 font-bold px-4 py-4 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                    Back
                </a>
            @endif

        </div>
    </div>
</x-admin-layout>
