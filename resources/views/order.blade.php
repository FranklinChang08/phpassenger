<x-main-layout title="Pemesanan Form">
    @section('header')
        @include('partials.navbar')
    @endsection
    @section('content')
        <section>
            <div class="grid grid-cols-1 gap-0 mt-20 p-2 lg:grid-cols-3 lg:gap-12 md:p-8 lg:p-12">
                <div class="form col-span-2 flex flex-col gap-12">
                    <div class="pemesanan p-12 bg-white shadow-lg rounded-lg space-y-4">
                        <h1 class="text-xl font-bold">Data Account Pemesan</h1>
                        <ul class="space-y-4">
                            <li>
                                <h6 class="text-sm text-gray-600">Nama Pemesan</h6>
                                <h2 class="bg-gray-100 p-2 rounded-md">{{ session('user')->nama }}</h2>
                            </li>
                            <li>
                                <h6 class="text-sm text-gray-600">Email Pemesan</h6>
                                <h2 class="bg-gray-100 p-2 rounded-md">{{ session('user')->email }}</h2>
                            </li>
                            <li>
                                <h6 class="text-sm text-gray-600">Nomor Telepon Pemesan</h6>
                                <h2 class="bg-gray-100 p-2 rounded-md">{{ session('user')->nomor_telepon }}</h2>
                            </li>
                        </ul>
                    </div>
                    <div class="detail-pemesanan">
                        <div class="card rounded-lg">
                            <form action="{{ route('order.detail') }}" method="POST" id="dynamic-form"
                                class="w-full flex flex-col gap-6 mt-6 md:flex-row" onsubmit="updateHarga()">
                                @csrf
                                <div id="dynamic-container" class="w-full flex flex-col">
                                    <div class="card bg-white p-6 rounded-lg space-y-4 w-full mt-4 mr-4 mb-4">
                                        <div class="header flex items-center justify-between">
                                            <h1 class="text-xl font-bold text-indigo-600">Penumpang 1</h1>
                                            <button type="button" onclick="toggleDropdown('Form-1')">
                                                <i class="fa-solid fa-chevron-down text-indigo-600"></i>
                                            </button>
                                        </div>
                                        <button type="button" onclick="popupKursiOpen('Model-1', 'popupContent-1')"
                                            class="flex w-full justify-between items-center bg-indigo-600/15 p-2 rounded-md">
                                            <div class="icon text-start">
                                                <p class="text-sm">Batam Center</p>
                                                <div class="flex gap-2">
                                                    <h2 class="font-bold">Kursi</h2>
                                                    <h2 class="font-bold" id="display-nomor-1"></h2>
                                                    <input type="hidden" name="pemesanan[1][id_kursi_plane]"
                                                        id="nomor_kursi-1" id="nomor_kursi" value=""
                                                        class="font-bold bg-transparent">
                                                </div>
                                            </div>
                                            <p class="text-indigo-600 font-bold">Ubah Kursi</p>
                                        </button>

                                        <div id="Model-1"
                                            class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
                                            <div class="bg-white rounded-lg p-6 w-full relative shadow-lg transform transition-transform scale-95 opacity-0 lg:w-1/2"
                                                id="popupContent-1">
                                                <button type="button"
                                                    onclick="popupKursiClose('Model-1', 'popupContent-1')"
                                                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                                                    <i class="fa-solid fa-times"></i>
                                                </button>
                                                <h2 class="text-xl font-bold text-center mb-2 text-indigo-600 uppercase">
                                                    Pilih Kursi Anda Penumpang 1</h2>
                                                <ul class="flex items-center justify-center gap-4 mb-4">
                                                    <li class="flex items-center gap-2">
                                                        <button type="button" disabled
                                                            class="bg-gray-400 text-white rounded-sm w-4 aspect-square p-2"></button>
                                                        Booked
                                                    </li>
                                                    <li class="flex items-center gap-2">
                                                        <button type="button" disabled
                                                            class="border border-gray-600 text-black rounded-sm w-4 aspect-square hover:ring hover:ring-indigo-500"></button>
                                                        Available
                                                    </li>
                                                    <li class="flex items-center gap-2">
                                                        <button type="button" disabled
                                                            class="bg-indigo-600 text-white rounded-sm w-4 aspect-square"></button>
                                                        Different Class
                                                    </li>
                                                </ul>
                                                <div class="w-full flex justify-center items-center bg-gray-200 rounded-md">
                                                    <div
                                                        class="list-kursi grid grid-cols-2 w-fit gap-4 h-96 overflow-y-auto no-scrollbar p-4">
                                                        @foreach ($kursiplane as $item)
                                                            @if ($item->status == 'Booked')
                                                                <button type="button" value="{{ $item->nomor_kursi }}"
                                                                    id="kursi-{{ $item->id_kursi_plane }}" disabled
                                                                    data-idkursiplane="{{ $item->id_kursi_plane }}"
                                                                    class="bg-gray-400 text-white rounded-md w-10 aspect-square kursi-button">
                                                                    {{ $item->nomor_kursi }}
                                                                </button>
                                                            @elseif ($jadwal->nama_kelas != $item->nama_kelas)
                                                                <button type="button" value="{{ $item->nomor_kursi }}"
                                                                    id="kursi-{{ $item->id_kursi_plane }}" disabled
                                                                    data-idkursiplane="{{ $item->id_kursi_plane }}"
                                                                    class="bg-indigo-600 text-white rounded-md w-10 aspect-square kursi-button">
                                                                    {{ $item->nomor_kursi }}
                                                                </button>
                                                            @else
                                                                <button type="button" value="{{ $item->nomor_kursi }}"
                                                                    id="kursi-{{ $item->id_kursi_plane }}"
                                                                    onclick="handleSeatSelection(this.value, 'Model-1', 'popupContent-1', 'nomor_kursi-1', 'display-nomor-1', {{ $item->id_kursi_plane }}, '1')"
                                                                    data-idkursiplane="{{ $item->id_kursi_plane }}"
                                                                    class="border border-gray-600 text-black rounded-md w-10 aspect-square hover:ring hover:ring-indigo-500 kursi-button">
                                                                    {{ $item->nomor_kursi }}
                                                                </button>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    onclick="popupKursiClose('Model-1', 'popupContent-1')"
                                                    class="bg-red-500 text-white px-4 py-2 rounded-lg mt-4">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                        <div class="input overflow-hidden transition-all duration-500 ease-in-out h-full space-y-4"
                                            id="Form-1">
                                            <div>
                                                <label for="nama_penumpang_1"
                                                    class="block text-sm font-medium text-gray-700">Nama Penumpang</label>
                                                <input required name="pemesanan[1][nama_penumpang]" id="nama_penumpang_1"
                                                    class="mt-1  w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                            </div>
                                            <div>
                                                <label for="nomor_identitas_1"
                                                    class="block text-sm font-medium text-gray-700">Nomor Identitas</label>
                                                <input required type="text" name="pemesanan[1][nomor_identitas]"
                                                    id="nomor_identitas_1"
                                                    class="mt-1  w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                            </div>
                                            <div>
                                                <input required type="hidden" name="pemesanan[1][harga_kursi]"
                                                    id="harga_kursi_1" value="{{ $jadwal->harga }}" readonly
                                                    class="mt-1  w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                            </div>
                                            <input type="hidden" name="pemesanan[1][id_pemesanan]"
                                                value="{{ $id_pemesanan }}">
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="flex flex-col w-full text-center justify-between items-center h-fit mt-4 gap-4 md:w-1/4">
                                    <div class="input flex w-full justify-between items-center bg-white shadow-lg p-4">
                                        <button type="button" id="add-form"
                                            class="font-bold w-10 aspect-square flex justify-center items-center text-white bg-indigo-600 rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                        <p id="total-kursi-display"></p>
                                        <button type="button" id="remove-form"
                                            class="w-10 aspect-square font-bold flex justify-center items-center px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                    </div>
                                    <div>
                                        <input type="hidden" id="total-harga-display-first" name="total_harga" readonly
                                            class="mt-1  w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                    </div>
                                    <button type="submit"
                                        class="w-fit font-bold px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-offset-1">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="jadwal-session sticky top-20 mt-12 z-0 lg:mt-0">
                    <div class="jadwal bg-white sticky top-20 h-fit shadow-lg rounded-lg flex flex-col gap-4 p-6">
                        <div class="asal flex items-center gap-4">
                            <h1 class="bg-indigo-600/20 w-fit text-indigo-600 p-2 rounded-md font-semibold">Pergi
                            </h1>
                            <div class="time">
                                <p class="font-semibold text-indigo-600">
                                    {{ date('D, d M Y', strtotime($jadwal->tanggal)) }}
                                </p>
                                <p>{{ $jadwal->waktu_berangkat }}</p>
                            </div>
                        </div>
                        <div class="rute flex font-bold items-center gap-3">
                            <p>{{ $jadwal->asal }}</p>
                            <i class="fa-solid fa-arrow-right"></i>
                            <p>{{ $jadwal->tujuan }}</p>
                        </div>
                        <div class="plane flex items-center text-sm text-gray-700 font-medium gap-3">
                            <i class="fa-solid fa-plane"></i>
                            <p>{{ $jadwal->nama_maskapai }} {{ $jadwal->nomor_penerbangan }}</p>
                            <div class="w-1 aspect-square bg-gray-500 rounded-full"></div>
                            <p>{{ $jadwal->nama_kelas }}</p>
                        </div>
                        <div class="h-[1px] w-full bg-gray-300"></div>
                        <div class="harga flex justify-between items-center">
                            <p>Total Price</p>
                            <p class="text-xl font-semibold" id="total-harga-display-second">IDR
                                {{ number_format($jadwal->harga, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('order.cancel', $id_pemesanan) }}" method="POST"
                class="fixed bottom-5 right-5 z-40">
                @csrf
                @method('DELETE')
                <button class="bg-gray-600 text-white font-semibold p-4 rounded-md">
                    Cancel
                </button>
            </form>
        </section>
        <script>
            function toggleDropdownForm(formId) {
                const form = document.getElementById(formId);

                if (!form) {
                    console.log("Form not found: " + formId);
                    return;
                }

                if (form.style.maxHeight) {
                    form.style.maxHeight = null; // Collapse
                } else {
                    form.style.maxHeight = form.scrollHeight + "px"; // Expand
                }
            }


            let selectedSeats = {}; // Objek untuk menyimpan kursi yang dipilih {id_kursi_plane: formCount}

            function updateSeatSelections() {
                let allSeatButtons = document.querySelectorAll('.kursi-button');

                allSeatButtons.forEach(button => {
                    let idKursiplane = button.dataset.idkursiplane;

                    if (selectedSeats[idKursiplane]) {
                        button.disabled = true;
                        button.classList.add('selected'); // Tambahkan kelas untuk kursi yang sudah dipilih
                    } else {
                        button.disabled = false;
                        button.classList.remove('selected'); // Hapus kelas untuk kursi yang tidak dipilih
                    }
                });
            }

            function handleSeatSelection(value, modalId, contentId, nomorKursiId, displayNomor, idKursiplane, formCount) {
                let inputKursi = document.getElementById(nomorKursiId);
                let displayKursi = document.getElementById(displayNomor);
                let allSeatButtons = document.querySelectorAll('.kursi-button');


                if (!selectedSeats[idKursiplane]) {
                    // Hapus pilihan kursi sebelumnya untuk form ini
                    Object.keys(selectedSeats).forEach(seatId => {
                        if (selectedSeats[seatId] === formCount) {
                            // Kembalikan tombol kursi ke status semula
                            const previousButton = document.querySelector(`.kursi-button[data-idkursiplane="${seatId}"]`);
                            if (previousButton) {
                                previousButton.disabled = false;
                                previousButton.classList.remove('selected');
                            }
                            delete selectedSeats[seatId];
                        }
                    });

                    // Simpan data kursi yang dipilih
                    selectedSeats[idKursiplane] = formCount;

                    // Perbarui input dan tampilan kursi
                    inputKursi.value = idKursiplane;
                    displayKursi.textContent = value;
                    popupKursiClose(modalId, contentId);

                    // Perbarui tombol kursi yang dipilih
                    const selectedButton = document.querySelector(`.kursi-button[data-idkursiplane="${idKursiplane}"]`);
                    if (selectedButton) {
                        selectedButton.disabled = true;
                        selectedButton.classList.add('selected');
                    }
                } else {
                    alert('Kursi ini sudah dipilih. Silakan pilih kursi lain.');
                }

                // Perbarui tampilan semua kursi
                updateSeatSelections();
            }

            function popupKursiClose(modalId, contentId) {
                let modal = document.getElementById(modalId);
                let content = document.getElementById(contentId);
                modal.classList.add('hidden'); // Hide modal
                content.classList.remove('opacity-100', 'scale-100'); // Remove opening animation
                content.classList.add('opacity-0', 'scale-95'); // Add closing animation
            }

            function popupKursiOpen(modalId, contentId) {
                let modal = document.getElementById(modalId);
                let content = document.getElementById(contentId);
                modal.classList.remove('hidden'); // Show modal
                content.classList.remove('opacity-0', 'scale-95'); // Remove closing animation
                content.classList.add('opacity-100', 'scale-100'); // Add opening animation
            }


            let formCount = 1; // Initialize with one form
            const hargaKursi = parseFloat("{{ $jadwal->harga }}"); // Price per seat

            const totalKursiDisplay = document.querySelector('#total-kursi-display');
            const totalHargaDisplayFirst = document.querySelector('#total-harga-display-first');
            const totalHargaDisplaySecond = document.querySelector('#total-harga-display-second');

            // Update the total number of seats
            function updateTotalKursi() {
                totalKursiDisplay.textContent = formCount;
            }

            // Update the total price
            function updateHarga() {
                let totalHarga = hargaKursi * formCount; // Multiply price by the number of forms
                if (totalHargaDisplayFirst) {
                    totalHargaDisplayFirst.value = totalHarga.toFixed(2); // Update hidden input
                }

                if (totalHargaDisplaySecond) {
                    totalHargaDisplaySecond.textContent =
                        `IDR ${totalHarga.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                }
            }

            document.getElementById('add-form').addEventListener('click', function() {
                formCount++;
                const container = document.getElementById('dynamic-container');
                const newForm = document.createElement('div');
                newForm.className = 'card bg-white p-6 rounded-lg space-y-4 w-full mt-4 mr-4 mb-4';
                newForm.innerHTML = `<div class="header flex items-center justify-between">
    <h1 class="text-xl font-bold text-indigo-600">Penumpang ${formCount}</h1>
    <button type="button" onclick="toggleDropdownForm('Form-${formCount}')">
        <i class="fa-solid fa-chevron-down text-indigo-600"></i>
    </button>
</div>
<button type="button" onclick="popupKursiOpen('Model-${formCount}', 'popupContent-${formCount}')"
    class="flex w-full justify-between items-center bg-indigo-600/15 p-2 rounded-md">
    <div class="icon text-start">
        <p class="text-sm">Batam Center</p>
        <div class="flex gap-2">
            <h2 class="font-bold">Kursi</h2>
            <h2 class="font-bold" id="display-nomor-${formCount}"></h2>
            <input type="hidden" name="pemesanan[${formCount}][id_kursi_plane]" id="nomor_kursi-${formCount}" value="" class="font-bold bg-transparent">
        </div>
    </div>
    <p class="text-indigo-600 font-bold">Ubah Kursi</p>
</button>

<div id="Model-${formCount}" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-white rounded-lg p-6 w-full relative shadow-lg transform transition-transform scale-95 opacity-0 lg:w-1/2" id="popupContent-${formCount}">
        <button type="button" onclick="popupKursiClose('Model-${formCount}', 'popupContent-${formCount}')"
            class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
            <i class="fa-solid fa-times"></i>
        </button>
        <h2 class="text-xl font-bold text-center mb-2 text-indigo-600 uppercase">
            Pilih Kursi Anda Penumpang ${formCount}</h2>
        <ul class="flex items-center justify-center gap-4 mb-4">
            <li class="flex items-center gap-2">
                <button type="button" disabled class="bg-gray-400 text-white rounded-sm w-4 aspect-square p-2"></button>
                Booked
            </li>
            <li class="flex items-center gap-2">
                <button type="button" disabled class="border border-gray-600 text-black rounded-sm w-4 aspect-square hover:ring hover:ring-indigo-500"></button>
                Available
            </li>
            <li class="flex items-center gap-2">
                <button type="button" disabled class="bg-indigo-600 text-white rounded-sm w-4 aspect-square"></button>
                Different Class
            </li>
        </ul>
        <div class="w-full flex justify-center items-center bg-gray-200 rounded-md">
            <div class="list-kursi grid grid-cols-2 w-fit gap-4 h-96 overflow-y-auto no-scrollbar p-4">
                @foreach ($kursiplane as $item)
                    @if ($item->status == 'Booked')
                        <button type="button" value="{{ $item->nomor_kursi }}" id="kursi-{{ $item->id_kursi_plane }}" disabled data-idkursiplane="{{ $item->id_kursi_plane }}"
                            class="bg-gray-400 text-white rounded-md w-10 aspect-square kursi-button">
                            {{ $item->nomor_kursi }}
                        </button>
                    @elseif ($jadwal->nama_kelas != $item->nama_kelas)
                        <button type="button" value="{{ $item->nomor_kursi }}" id="kursi-{{ $item->id_kursi_plane }}" disabled
                            data-idkursiplane="{{ $item->id_kursi_plane }}" class="bg-indigo-600 text-white rounded-md w-10 aspect-square kursi-button">
                            {{ $item->nomor_kursi }}
                        </button>
                    @else
                        <button type="button" value="{{ $item->nomor_kursi }}" id="kursi-{{ $item->id_kursi_plane }}"
                            onclick="handleSeatSelection(this.value, 'Model-${formCount}', 'popupContent-${formCount}', 'nomor_kursi-${formCount}', 'display-nomor-${formCount}', {{ $item->id_kursi_plane }}, ${formCount})"
                            data-idkursiplane="{{ $item->id_kursi_plane }}" class="border border-gray-600 text-black rounded-md w-10 aspect-square hover:ring hover:ring-indigo-500 kursi-button">
                            {{ $item->nomor_kursi }}
                        </button>
                    @endif
                @endforeach
            </div>
        </div>
        <button type="button" onclick="popupKursiClose('Model-${formCount}', 'popupContent-${formCount}')"
            class="bg-red-500 text-white px-4 py-2 rounded-lg mt-4">Close</button>
    </div>
</div>

<div class="input overflow-hidden transition-all duration-500 ease-in-out max-h-0 space-y-4"
                                            id="Form-${formCount}">
                                            <div>
                                                <label for="nama_penumpang_${formCount}"
                                                    class="block text-sm font-medium text-gray-700">Nama Penumpang</label>
                                                <input required name="pemesanan[${formCount}][nama_penumpang]" id="nama_penumpang_${formCount}"
                                                    class="mt-1  w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                            </div>
                                            <div>
                                                <label for="nomor_identitas_${formCount}"
                                                    class="block text-sm font-medium text-gray-700">Nomor Identitas</label>
                                                <input required type="text" name="pemesanan[${formCount}][nomor_identitas]"
                                                    id="nomor_identitas_${formCount}"
                                                    class="mt-1  w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                            </div>
                                            <div>
                                                <input required type="hidden" name="pemesanan[${formCount}][harga_kursi]"
                                                    id="harga_kursi_${formCount}" value="{{ $jadwal->harga }}" readonly
                                                    class="mt-1  w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                            </div>
                                            <input type="hidden" name="pemesanan[${formCount}][id_pemesanan]"
                                                value="{{ $id_pemesanan }}">
                                        </div>

    `;

                container.appendChild(newForm);
                updateTotalKursi();
                updateHarga();
                updateSeatSelections();

                const kursiButtons = newForm.querySelectorAll('.kursi-btn');
                kursiButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        showAlert(this.value, `Model-${formCount}`, `popupContent-${formCount}`,
                            `nomor_kursi-${formCount}`);
                    });
                });
            });

            document.getElementById('remove-form').addEventListener('click', function() {
                if (formCount > 1) {
                    const lastForm = document.querySelector(`#dynamic-container .card:last-child`);
                    if (lastForm) {
                        // Deselect kursi yang terkait dengan form ini
                        const nomorKursiInput = lastForm.querySelector('input[name*="[id_kursi_plane]"]');
                        if (nomorKursiInput && nomorKursiInput.value) {
                            const kursiId = nomorKursiInput.value;

                            // Reset tombol kursi yang terkait
                            const seatButton = document.querySelector(`.kursi-button[data-idkursiplane="${kursiId}"]`);
                            if (seatButton) {
                                seatButton.disabled = false;
                                seatButton.classList.remove('selected'); // Hapus gaya 'selected' jika ada
                            }

                            // Hapus kursi dari daftar pilihan
                            delete selectedSeats[kursiId];
                        }

                        // Hapus form
                        lastForm.remove();
                        formCount--;

                        // Perbarui total kursi, harga, dan tampilan lainnya
                        updateTotalKursi();
                        updateHarga();
                        updateSeatSelections();
                    }
                }
            });


            updateTotalKursi();
            updateHarga();
        </script>

        <style>
            .seat-button {
                transition: background-color 0.3s ease;
            }

            .seat-button[disabled] {
                pointer-events: none;
            }

            .kursi-button.selected {
                background-color: #4CAF50;
                /* Hijau untuk kursi yang dipilih */
                color: white;
                border: 2px solid #388E3C;
                pointer-events: none;
                /* Nonaktifkan interaksi */
            }
        </style>
    @endsection
    @section('footer')
        @include('partials.footer')
    @endsection
</x-main-layout>
