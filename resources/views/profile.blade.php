<x-main-layout title="Profile">
    @section('header')
        @include('partials.navbar')
    @endsection
    @section('content')
        <section>
            <div class="w-full h-56 bg-gradient-to-l from-indigo-300 to-indigo-600 relative flex ">
                <div
                    class="absolute top-48 grid grid-cols-1 gap-0 space-y-2 px-2 w-full  lg:grid-cols-4 lg:gap-2 md:px-6 lg:px-12">
                    <div
                        class="bg-white h-fit shadow-lg rounded-md p-4 flex flex-col mt-2 justify-center items-center gap-6 lg:sticky lg:top-16">
                        <div class="profile text-center space-y-2">
                            <div
                                class="bg-gradient-to-r from-indigo-500 to-indigo-600 w-fit aspect-square rounded-full flex justify-center items-center">
                                <div class="bg-white m-1 rounded-full flex justify-center items-center">
                                    <img src="{{ asset(session('user')->photo_profile) }}" alt=""
                                        class="p-1 w-64 h-64 rounded-full object-cover">

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
                                    <p class="text-green-600 font-bold">{{ $pemesanan->count() }}</p>
                                </div>
                            </li>
                            <li class="p-2 bg-gray-100 ">
                                <div class="flex justify-between items-center">
                                    <p class="font-medium">Total Ticket Pemesanan</p>
                                    <p class="text-blue-600 font-bold">{{ $detailpemesanan->count() }}</p>
                                </div>
                            </li>
                            <li class="p-2 bg-gray-100 ">
                                <div class="flex justify-between items-center">
                                    <p class="font-medium">Total Pembayaran</p>
                                    <p class="text-orange-600 font-bold">{{ $transaksi->count() }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white col-span-3 w-full shadow-lg space-y-4 rounded-md p-4 flex flex-col mb-12">
                        <div class="w-full mx-auto shadow-md rounded-lg p-6">
                            <h2 class="text-2xl font-bold text-indigo-600 mb-4">Change Profile</h2>
                            <form action="{{ route('profile.update', session('user')->id_pengguna) }}"
                                enctype="multipart/form-data" method="POST" class="space-y-4 grid grid-cols-1 lg:grid-cols-2">
                                @csrf
                                @method('PUT')
                                <!-- Full Name -->
                                <div
                                    class="row-span-1 md:row-span-3 col-span-2 lg:col-span-1 flex items-center justify-center w-full gap-4">
                                    <!-- Image Preview -->
                                    @if (session('user')->photo_profile)
                                        <img id="imagePreview"
                                            class="w-80 h-80 object-cover rounded-lg border border-white/50 shadow-[0_0_15px_rgba(255,255,255,0.5)] "
                                            src="{{ asset(session('user')->photo_profile) }}">
                                    @else
                                        <img id="imagePreview"
                                            class="w-80 h-80 object-cover rounded-lg border border-white/50 shadow-[0_0_15px_rgba(255,255,255,0.5)]  hidden">
                                    @endif
                                </div>
                                <div class="space-y-4">
                                    <div id="dropzone"
                                        class="w-full col-span-2 lg:col-span-1 p-2 border-2 border-dashed border-gray-500 rounded-lg text-center cursor-pointer bg-white/5 hover:bg-white/10 transition">
                                        <p class="text-gray-600 font-bold text-sm">Click Or Drop an image</p>
                                        <input type="file" id="fileInput" value="" name="photo_profile"
                                            accept="image/*" class="hidden">
                                    </div>
                                    <div>
                                        <label for="nama" class="block text-sm font-medium text-gray-700">Full
                                            Name</label>
                                        <input type="text" id="nama" name="nama"
                                            placeholder="Enter your full name" value="{{ session('user')->nama }}"
                                            class="mt-1 p-2 bg-gray-100 text-gray-600 font-medium block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-600 focus:outline-none">
                                        @error('nama')
                                            <div class="flex items-center p-4 my-4 text-sm text-red-800 bg-red-100 rounded-lg"
                                                role="alert">
                                                <svg class="w-5 h-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.366-.74 1.43-.74 1.796 0l6.348 12.857c.334.675-.126 1.443-.898 1.443H2.807c-.772 0-1.232-.768-.898-1.443L8.257 3.1zM9 13a1 1 0 112 0 1 1 0 01-2 0zm.25-4.75a.75.75 0 10-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium mr-2">Warning:</span>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" id="email" name="email" placeholder="Enter your email"
                                            value="{{ session('user')->email }}"
                                            class="mt-1 p-2 bg-gray-100 text-gray-600 font-medium block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-600 focus:outline-none">
                                        @error('email')
                                            <div class="flex items-center p-4 my-4 text-sm text-red-800 bg-red-100 rounded-lg"
                                                role="alert">
                                                <svg class="w-5 h-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.366-.74 1.43-.74 1.796 0l6.348 12.857c.334.675-.126 1.443-.898 1.443H2.807c-.772 0-1.232-.768-.898-1.443L8.257 3.1zM9 13a1 1 0 112 0 1 1 0 01-2 0zm.25-4.75a.75.75 0 10-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium mr-2">Warning:</span>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label for="nomor_telepon"
                                            class="block text-sm font-medium text-gray-700">Phone</label>
                                        <input type="tel" id="nomor_telepon" name="nomor_telepon"
                                            placeholder="Enter your nomor_telepon number"
                                            value="{{ session('user')->nomor_telepon }}"
                                            class="mt-1 p-2 bg-gray-100 text-gray-600 font-medium block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-600 focus:outline-none">
                                        @error('nomor_telepon')
                                            <div class="flex items-center p-4 my-4 text-sm text-red-800 bg-red-100 rounded-lg"
                                                role="alert">
                                                <svg class="w-5 h-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.366-.74 1.43-.74 1.796 0l6.348 12.857c.334.675-.126 1.443-.898 1.443H2.807c-.772 0-1.232-.768-.898-1.443L8.257 3.1zM9 13a1 1 0 112 0 1 1 0 01-2 0zm.25-4.75a.75.75 0 10-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium mr-2">Warning:</span>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="w-fit bg-indigo-600 text-white py-2 px-4 rounded-md font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                                            Save Changes
                                        </button>
                                    </div>
                                </div>
            
                            </form>
                        </div>
                        <div class="w-full mx-auto shadow-md rounded-lg p-6">
                            <h2 class="text-2xl font-bold text-indigo-600 mb-4">Change Password</h2>
                            <form action="{{ route('profile.updatepassword', session('user')->id_pengguna) }}"
                                method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <!-- Email -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" id="password" name="password"
                                        placeholder="Enter your new password"
                                        class="mt-1 p-2 bg-gray-100 text-gray-600 font-medium block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-600 focus:outline-none">
                                    @error('password')
                                        <div class="flex items-center p-4 my-4 text-sm text-red-800 bg-red-100 rounded-lg"
                                            role="alert">
                                            <svg class="w-5 h-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M8.257 3.099c.366-.74 1.43-.74 1.796 0l6.348 12.857c.334.675-.126 1.443-.898 1.443H2.807c-.772 0-1.232-.768-.898-1.443L8.257 3.1zM9 13a1 1 0 112 0 1 1 0 01-2 0zm.25-4.75a.75.75 0 10-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-medium mr-2">Warning:</span>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Full Name -->
                                <div>
                                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm
                                        Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password"
                                        placeholder="Enter your confirm passwordz"
                                        class="mt-1 p-2 bg-gray-100 text-gray-600 font-medium block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-600 focus:outline-none">
                                    @error('confirm_password')
                                        <div class="flex items-center p-4 my-4 text-sm text-red-800 bg-red-100 rounded-lg"
                                            role="alert">
                                            <svg class="w-5 h-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M8.257 3.099c.366-.74 1.43-.74 1.796 0l6.348 12.857c.334.675-.126 1.443-.898 1.443H2.807c-.772 0-1.232-.768-.898-1.443L8.257 3.1zM9 13a1 1 0 112 0 1 1 0 01-2 0zm.25-4.75a.75.75 0 10-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-medium mr-2">Warning:</span>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Submit Button -->
                                <div>
                                    <button type="submit"
                                        class="w-fit bg-indigo-600 text-white py-2 px-4 rounded-md font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="w-full mx-auto space-y-4 rounded-lg gap-4" id="History">
                            <form action="" method="GET"
                                class="flex flex-wrap items-center gap-4 p-4 bg-indigo-50 rounded-lg shadow-md">
                                <!-- Input Date -->
                                <div class="relative">
                                    <input type="date" name="date"
                                        class="bg-indigo-200 text-indigo-800 placeholder-indigo-500 p-2 px-4 rounded-md focus:outline-none focus:ring focus:ring-indigo-600"
                                        value="{{ request('date') }}" />
                                </div>

                                <!-- Dropdown Select -->
                                <div class="relative">
                                    <select name="status_pembayaran"
                                        class="bg-indigo-200 text-indigo-800 p-2 px-4 rounded-md focus:outline-none focus:ring focus:ring-indigo-600">
                                        <option value="" {{ request('status_pembayaran') == '' ? 'selected' : '' }}>
                                            All</option>
                                        <option value="Pending"
                                            {{ request('status_pembayaran') == 'Pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="Completed"
                                            {{ request('status_pembayaran') == 'Completed' ? 'selected' : '' }}>Completed
                                        </option>
                                        <option value="Confirmed"
                                            {{ request('status_pembayaran') == 'Confirmed' ? 'selected' : '' }}>Confirmed
                                        </option>
                                        <option value="Cancelled"
                                            {{ request('status_pembayaran') == 'Cancelled' ? 'selected' : '' }}>Cancelled
                                        </option>
                                        <option value="Refund"
                                            {{ request('status_pembayaran') == 'Refund' ? 'selected' : '' }}>Refund
                                        </option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit"
                                    class="flex items-center justify-center bg-indigo-600 text-white p-2 px-6 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-300">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <span class="ml-2">Search</span>
                                </button>
                            </form>


                            <div class="grid grid-cols-1">
                                <div class="pembayaran">
                                    <h2 class="text-md font-bold text-indigo-600 mb-4">History Payment</h2>
                                    <div class="w-full flex flex-col gap-2">
                                        @if ($transaksi && $transaksi->count() > 0)
                                            @foreach ($transaksi as $item)
                                                @php
                                                    $textColor = '';
                                                    $bgColor = '';
                                                    $statusMessage = ''; // Untuk menyimpan pesan status pembayaran
                                                    switch ($item->status_pembayaran) {
                                                        case 'Pending':
                                                            $textColor = 'text-blue-700';
                                                            $bgColor = 'bg-blue-200';
                                                            $statusMessage =
                                                                'Pembayaran Anda saat ini masih dalam status tertunda. Kami sedang memverifikasi transaksi Anda untuk memastikan semuanya berjalan dengan baik. Harap bersabar, karena proses ini mungkin memerlukan beberapa saat untuk diproses. Anda akan segera menerima pemberitahuan setelah transaksi ini selesai diproses. Jika ada pertanyaan atau masalah terkait pembayaran ini, silakan hubungi tim kami, dan kami akan dengan senang hati membantu Anda.';
                                                            break;
                                                        case 'Confirmed':
                                                            $textColor = 'text-green-700';
                                                            $bgColor = 'bg-green-200';
                                                            $statusMessage =
                                                                'Pembayaran Anda telah berhasil kami konfirmasi! Kami senang menginformasikan bahwa pembayaran Anda telah diterima dan pesanan Anda sedang diproses. Terima kasih atas kepercayaan Anda kepada kami. Kami akan segera mengatur pengiriman atau layanan yang Anda pesan. Jika ada informasi lebih lanjut atau pertanyaan seputar pesanan ini, tim customer service kami siap membantu Anda kapan saja.';
                                                            break;
                                                        case 'Completed':
                                                            $textColor = 'text-blue-700';
                                                            $bgColor = 'bg-blue-200';
                                                            $statusMessage =
                                                                'Pemesanan Anda telah berhasil diselesaikan! Pembayaran Anda telah diproses dengan lancar, dan transaksi Anda kini selesai. Kami mengucapkan terima kasih atas kepercayaan Anda menggunakan layanan kami. Jika Anda membutuhkan bantuan lebih lanjut atau memiliki pertanyaan mengenai pesanan ini, jangan ragu untuk menghubungi kami. Semoga pengalaman Anda menyenangkan!';
                                                            break;
                                                        case 'Cancelled':
                                                            $textColor = 'text-red-700';
                                                            $bgColor = 'bg-red-200';
                                                            $statusMessage =
                                                                'Pemesanan Anda telah dibatalkan. Kami sangat menyesal bahwa pesanan ini tidak dapat diproses lebih lanjut. Pembatalan ini mungkin disebabkan oleh masalah pembayaran atau permintaan Anda. Jika pembatalan ini adalah kesalahan atau jika Anda ingin mendiskusikan lebih lanjut mengenai hal ini, silakan hubungi kami. Kami siap membantu Anda menyelesaikan masalah ini dan memberikan solusi terbaik.';
                                                            break;
                                                        case 'Refund':
                                                            $textColor = 'text-red-700';
                                                            $bgColor = 'bg-red-200';
                                                            $statusMessage = 'Pengajuan refund pembayaran Anda telah kami terima dan saat ini sedang dalam proses. Kami sedang memastikan bahwa seluruh detail transaksi telah diverifikasi dengan baik agar refund dapat dilakukan dengan lancar. Proses ini mungkin membutuhkan waktu 3–7 hari kerja untuk selesai, tergantung pada metode pembayaran yang Anda gunakan.

Anda akan menerima pemberitahuan segera setelah refund selesai diproses. Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut terkait proses ini, jangan ragu untuk menghubungi tim kami. Kami akan dengan senang hati membantu Anda.';
                                                            break;
                                                        default:
                                                            $textColor = 'text-gray-700';
                                                            $bgColor = 'bg-gray-200';
                                                            $statusMessage = 'Status pesanan tidak diketahui.';
                                                    }
                                                @endphp
                                                <div class="card w-full shadow-lg rounded-lg">
                                                    <div
                                                        class="flex {{ $bgColor }} rounded-md p-2 px-4 justify-between items-center h-full transition-all duration-300 ease-in-out">
                                                        <div class="flex justify-center items-center gap-4">
                                                            <i class="fa-solid fa-receipt {{ $textColor }}"></i>
                                                            <div class="text">
                                                                <h6 class="font-bold text-sm {{ $textColor }}">
                                                                    {{ $item->asal }} to {{ $item->tujuan }}</h6>
                                                                <p class="font-medium text-xs {{ $textColor }}">
                                                                    {{ date('D, d M Y', strtotime($item->tanggal_pembayaran)) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="flex gap-4 items-center">
                                                            <p class="text-xs {{ $textColor }}">
                                                                {{ $item->status_pembayaran }}
                                                            </p>
                                                            <button class="relative group"
                                                                onclick="dropdownPayment({{ $item->id_transaction }})">
                                                                <i id="icon-{{ $item->id_transaction }}"
                                                                    class="fa-solid fa-chevron-down {{ $textColor }}"></i>
                                                                <span
                                                                    class="hidden group-hover:block text-xs absolute -left-12 bottom-7 bg-blue-300 p-1 px-2 font-semibold w-fit text-nowrap rounded-full">
                                                                    Lihat Pesanan
                                                                </span>
                                                            </button>
                                                            @if (!in_array($item->status_pembayaran, ['Pending', 'Cancelled', 'Refund']))
                                                                <form action="{{ route('transaction.refundCustomer') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="id_transaction"
                                                                        value="{{ $item->id_transaction }}">
                                                                    <button class="relative group">
                                                                        <i
                                                                            class="fa-regular fa-credit-card {{ $textColor }}"></i>
                                                                        <span
                                                                            class="hidden group-hover:block text-xs absolute bottom-7 bg-blue-300 p-1 px-2 font-semibold w-fit text-nowrap rounded-r-full rounded-tl-full">
                                                                            Refund
                                                                        </span>
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            @if ($item->status_pembayaran == 'Pending')
                                                                <a href="{{ route('transaction.viewCustomerPending', $item->id_transaction) }}"
                                                                    class="relative group p-2">
                                                                    <i
                                                                        class="fa-solid fa-ellipsis-vertical {{ $textColor }}"></i>
                                                                    <span
                                                                        class="hidden group-hover:block text-xs absolute bottom-7 bg-blue-300 p-1 px-2 font-semibold w-fit text-nowrap rounded-r-full rounded-tl-full">
                                                                        Bayar
                                                                    </span>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Konten yang akan ditampilkan atau disembunyikan berdasarkan klik -->
                                                    <div id="content-{{ $item->id_transaction }}"
                                                        class="overflow-hidden max-h-0 transition-all duration-300">
                                                        <div
                                                            class="content p-2 px-4 grid grid-cols-1 gap-4 lg:grid-cols-2">
                                                            @if ($item->status_pembayaran == 'Refund')
                                                                <p
                                                                    class="font-medium text-md col-span-2 text-start p-2 first-line:uppercase first-line:font-bold first-line:{{ $textColor }} first-letter:text-7xl first-letter:font-bold first-letter:float-left">
                                                                    {{ $statusMessage }}
                                                                </p>
                                                            @else
                                                                <p
                                                                    class="font-medium text-md text-start p-2 first-line:uppercase first-line:font-bold first-line:{{ $textColor }} first-letter:text-7xl first-letter:font-bold first-letter:float-left">
                                                                    {{ $statusMessage }}
                                                                </p>
                                                            @endif
                                                            @if ($item->status_pembayaran != 'Refund')
                                                                <div class="grid grid-col-1 gap-4">
                                                                    @foreach ($item->pemesanan->detailPemesanan as $itemDetail)
                                                                        <div
                                                                            class="card w-full h-fit rounded-md overflow-hidden flex flex-col items-center justify-center transition duration-300 ease-in-out">
                                                                            <div
                                                                                class="headline w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4 flex justify-between items-center">
                                                                                <div>
                                                                                    <h1 class="text-lg font-bold">
                                                                                        {{ $item->nama_bus }}</h1>
                                                                                    <p class="text-sm opacity-80">
                                                                                        {{ $itemDetail->nama_penumpang }}
                                                                                        {{ $itemDetail->nomor_identitas }}
                                                                                    </p>
                                                                                </div>
                                                                                <p class="text-md font-medium">
                                                                                    {{ date('D, d M Y', strtotime($item->tanggal)) }}
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="harga w-full p-2 flex justify-end items-center">
                                                                                <h1 class="text-gray-500 font-semibold">
                                                                                    <span
                                                                                        class="text-xl text-blue-600">IDR
                                                                                        {{ number_format($itemDetail->harga_kursi, 2, ',', '.') }}</span>/Kursi
                                                                                </h1>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 border-2 border-yellow-300 bg-yellow-100 rounded-lg"
                                                role="alert">
                                                <svg class="w-5 h-5 mr-2 text-yellow-600"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.366-.74 1.43-.74 1.796 0l6.348 12.857c.334.675-.126 1.443-.898 1.443H2.807c-.772 0-1.232-.768-.898-1.443L8.257 3.1zM9 13a1 1 0 112 0 1 1 0 01-2 0zm.25-4.75a.75.75 0 10-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="font-medium mr-2">Warning:</span>You have never made a
                                                payment.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            function dropdownPayment(id) {
                const content = document.getElementById(`content-${id}`);
                const icon = document.getElementById(`icon-${id}`);

                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                    icon.style.transform = "rotate(0deg)";
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                    icon.style.transform = "rotate(180deg)";
                }
            }
        </script>
    @endsection


</x-main-layout>
