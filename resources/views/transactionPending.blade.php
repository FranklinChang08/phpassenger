<x-main-layout title="Jadwal">
    @section('header')
        @include('partials.navbar')
    @endsection
    @section('content')
        <section>
            <div class="grid grid-cols-1 lg:grid-cols-3 p-6 gap-0 space-y-4 mt-14 lg:gap-6 lg:space-y-0">
                <!-- Payment Details -->
                <div class="col-span-2 bg-white w-full rounded-lg p-4">
                    <h1 class="text-2xl font-medium mb-6">Payment Details</h1>
                    <div class="flex flex-col gap-4">
                        <!-- QR Code and Credit Card Section -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- QR Code Section -->
                            <div class="qr">
                                <h1 class="text-sm font-semibold text-gray-600 mb-2">Via QR Code</h1>
                                <div class="flex justify-center items-center">
                                    <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                        <img src="https://i.pinimg.com/736x/d8/11/10/d81110f74b45542aa26eddc290592ed8.jpg"
                                            alt="QR Code" class="max-w-full h-auto">
                                    </div>
                                </div>
                            </div>
                            <!-- Credit Card Section -->
                            <div class="bank md:col-span-2">
                                <h1 class="text-sm font-semibold text-gray-600 mb-2">Via Credit Card/ Debit Card</h1>
                                <div class="relative w-full rounded-md overflow-hidden">
                                    <img src="{{ asset('static/img/credit_card_texture.jpg') }}" alt=""
                                        class="absolute inset-0 w-full h-72 object-cover z-0">
                                    <div
                                        class="relative text-white p-4 rounded-lg shadow-md h-72 z-10 flex flex-col justify-between">
                                        <div class="flex justify-between items-center">
                                            <p class="text-sm font-medium">Bank Name</p>
                                            <h1 class="text-lg font-bold">Bank Central</h1>
                                        </div>
                                        <img src="{{ asset('static/img/credit-card-cip.png') }}" alt=""
                                            class="w-28 md:w-36">
                                        <div>
                                            <h1 class="text-2xl tracking-widest font-light" id="credit-no">1234 5678 9012
                                                3456</h1>
                                            <p class="text-sm uppercase" id="credit-name">Franklin Sebastian Felix</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Form Section -->
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
                                    payment using the form below.</span>
                            </div>
                            <form action="{{ route('transaction.updateCustomerPending', $id_transaction) }}" class="w-full bg-white p-4 rounded-lg"
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
                                <button type="submit" class="bg-indigo-600 text-white font-semibold rounded-md p-2">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Ticket Order -->
                <div class="side bg-white shadow-md rounded-lg p-6">
                    <h1 class="font-bold text-indigo-600 text-2xl uppercase mb-4">Ticket Order</h1>
                    <div class="allcard flex flex-col gap-4 overflow-y-auto pr-2 max-h-96">
                        @if ($detailpemesanan && $detailpemesanan->count() > 0)
                            @foreach ($detailpemesanan as $data_detail)
                                @php
                                    $totalMinutes = 0;
                                @endphp
                                <div class="card flex h-full flex-col lg:flex-row shadow-md rounded-md overflow-hidden bg-white">
                                    <!-- Ticket Details -->
                                    <div class="flex-1 flex flex-col">
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
                            <div class="flex items-center p-3 text-sm text-red-800 bg-red-100 rounded-md">
                                <svg class="w-4 h-4 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
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
            <form action="{{ route('transaction.cancelCustomer', $pemesanan->id_pemesanan) }}" method="POST"
                class="fixed bottom-5 right-5 z-40">
                @csrf
                @method('DELETE')
                <button class="bg-gray-600 text-white font-semibold p-4 rounded-md">Cancel</button>
            </form>
        </section>

    @endsection
    @section('footer')
        @include('partials.footer')
    @endsection
</x-main-layout>
