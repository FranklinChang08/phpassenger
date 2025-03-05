<x-admin-layout>
    <div
        class="nav sticky top-0 left-0 bg-white p-4 rounded-lg mr-4 mt-4 shadow-md flex justify-between items-center z-0">
        <h1 class="text-gray-800 font-bold">Create Rute</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                Logout
            </button>
        </form>
    </div>

    <section>
        <div class="grid grid-cols-1 lg:grid-cols-3 p-6 gap-2 mt-14">
            <div class="col-span-2 bg-white w-full rounded-lg p-4 h-fit">
                <h1 class="text-2xl font-medium">Payment Details</h1>
                <div class="flex flex-col gap-2">
                    <div class="grid grid-cols-3 h-full gap-2 place-items-start">
                        <div class="qr">
                            <h1 class="text-sm font-semibold text-gray-600">Via QR Code</h1>
                            <!-- QR Code Section -->
                            <div class="flex justify-center items-center">
                                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                    <img src="https://i.pinimg.com/736x/d8/11/10/d81110f74b45542aa26eddc290592ed8.jpg"
                                        alt="">
                                </div>
                            </div>
                        </div>
                        <div class="bank col-span-2 h-full w-full">
                            <h1 class="text-sm font-semibold text-gray-600">Via Credit Card/ Debit Card</h1>
                            <div class="w-full relative rounded-md">
                                <img src="{{ asset('static/img/credit_card_texture.jpg') }}"
                                    class="absolute inset-0 rounded-md w-full h-64 z-0" alt="">
                                <div
                                    class=" text-white p-4 rounded-lg shadow-md mb-6 w-full h-64 absolute inset-0 z-20">
                                    <div class="grid grid-cols-1 content-between h-full">
                                        <div class="w-full flex justify-between items-center">
                                            <p class="text-sm font-medium">Bank Name</p>
                                            <h1 class="text-lg font-bold">Bank Central</h1>
                                        </div>
                                        <img src="{{ asset('static/img/credit-card-cip.png') }}" class="w-36"
                                            alt="">
                                        <div class="credit-detail">
                                            <h1 class="text-2xl tracking-widest font-light" id="credit-no">1234 5678
                                                9012
                                                3456</h1>

                                            <p class="text-sm uppercase" id="credit-name">Franklin Sebastian Felix</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form mt-6">
                        <div class="alert flex items-center p-4 mb-4 text-sm text-indigo-800 bg-indigo-100 rounded-lg"
                            role="alert">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.366-.74 1.43-.74 1.796 0l6.348 12.857c.334.675-.126 1.443-.898 1.443H2.807c-.772 0-1.232-.768-.898-1.443L8.257 3.1zM9 13a1 1 0 112 0 1 1 0 01-2 0zm.25-4.75a.75.75 0 10-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">Notice:</span>
                            <span class="ml-2">Transfer to credit card or scan the barcode above and send the proof of
                                payment in from below.</span>
                        </div>
                        <form action="{{ route('transaction.store') }}" class="w-full bg-white p-6 rounded-lg"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-6">
                                <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fa-solid fa-file-alt mr-2 text-indigo-500"></i> Upload Payment Proof
                                </label>
                                <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" required
                                    class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 file:bg-indigo-300 file:border-none file:p-2 file:rounded-md file:font-bold file:text-indigo-600">
                                @error('bukti_pembayaran')
                                    <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <input type="hidden" name="id_transaction" value="{{ $id_transaction }}">
                                <button type="submit"
                                    class="relative bg-indigo-600 font-poppins w-fit inline-flex items-center justify-start p-2 drop-shadow-[5px_5px_10px_rgba(255,255,255,0.8)] text-white font-semibold rounded-md overflow-hidden group focus:outline-none active:scale-95">
                                    <span
                                        class="absolute inset-y-0 left-0 bg-indigo-300 transition-width duration-300 ease-in-out transform w-0 group-hover:w-full"></span>
                                    <span
                                        class="relative z-10 font-bold text-md text-white transition-width duration-300 ease-in-out group-hover:text-indigo-600">Kirim</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="side bg-white shadow-md rounded-lg p-6">
                <h1 class="font-bold text-indigo-600 text-2xl uppercase mb-4">Ticket Order</h1>

                <div class="allcard flex flex-col gap-4 overflow-y-auto pr-2">
                    @if ($detailpemesanan && $detailpemesanan->count() > 0)
                        @foreach ($detailpemesanan as $data_detail)
                            @php
                                $totalMinutes = 0;
                            @endphp
                            <div class="card flex flex-col lg:flex-row shadow-md rounded-md overflow-hidden bg-white">
                                <!-- Right Section: Bus Details -->
                                <div class="flex-1 flex flex-col">
                                    <!-- Headline -->
                                    <div class="headline bg-gradient-to-r from-indigo-500 to-indigo-600 text-white p-4">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h1 class="text-lg font-bold">{{ $pemesanan->nama_bus }}</h1>
                                                <p class="text-xs opacity-80">{{ $data_detail->nama_kelas }}</p>
                                            </div>
                                            <p class="text-xs font-medium">
                                                {{ date('D, d M Y', strtotime($data_detail->tanggal)) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Route Details -->
                                    <div class="desc bg-gray-50 p-4">
                                        <div class="rute flex items-center gap-4">
                                            <div class="flex flex-col items-center text-center">
                                                <div
                                                    class="circle w-3 h-3 rounded-full shadow-md border-2 border-sky-500">
                                                </div>
                                                <p class="text-sm mt-2 text-gray-700">{{ $pemesanan->waktu_berangkat }}
                                                </p>
                                                <p class="text-sm font-medium text-gray-800">{{ $pemesanan->asal }}</p>
                                            </div>
                                            <div class="flex-1 relative">
                                                <div
                                                    class="line h-[2px] bg-gradient-to-r from-gray-300 via-gray-500 to-gray-300 w-full">
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
                                                        class="dot absolute top-[-20px] left-1/2 transform -translate-x-1/2 text-xs font-semibold text-slate-700">
                                                        {{ $hours }}h
                                                    </div>
                                                @else
                                                    <div
                                                        class="dot absolute top-[-20px] left-1/2 transform -translate-x-1/2 text-xs font-semibold text-slate-700">
                                                        {{ $hours }}h {{ $minutes }}m
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex flex-col items-center text-center">
                                                <div
                                                    class="circle w-3 h-3 rounded-full shadow-md border-2 border-slate-700">
                                                </div>
                                                <p class="text-sm mt-2 text-gray-700">{{ $pemesanan->waktu_tiba }}</p>
                                                <p class="text-sm font-medium text-gray-800">{{ $pemesanan->tujuan }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="harga bg-gray-100 p-3 flex justify-between items-center">
                                        <p class="text-gray-600 text-sm font-medium">Harga per Kursi:</p>
                                        <h1 class="text-xl font-bold text-indigo-600">
                                            IDR {{ number_format($data_detail->harga_kursi, 2, ',', '.') }}
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="flex items-center p-3 mb-3 text-sm text-red-800 bg-red-100 rounded-md"
                            role="alert">
                            <svg class="w-4 h-4 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.366-.74 1.43-.74 1.796 0l6.348 12.857c.334.675-.126 1.443-.898 1.443H2.807c-.772 0-1.232-.768-.898-1.443L8.257 3.1zM9 13a1 1 0 112 0 1 1 0 01-2 0zm.25-4.75a.75.75 0 10-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium mr-2">Warning:</span> Mohon Maaf jadwal yang anda cari tidak
                            tersedia.
                        </div>
                    @endif

                </div>
            </div>

        </div>
        <form action="{{ route('transaction.cancelAdmin', $id_pemesanan) }}" method="POST"
            class="fixed bottom-5 right-5 z-40">
            @csrf
            @method('DELETE')
            <button class="bg-gray-600 text-white font-semibold p-4 rounded-md">
                Cancel
            </button>
        </form>
    </section>
</x-admin-layout>
