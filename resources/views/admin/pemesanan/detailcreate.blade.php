<x-admin-layout>
    <div
        class="nav sticky top-0 left-0 bg-white p-4 rounded-lg mr-4 mt-4 shadow-md flex justify-between items-center z-0">
        <h1 class="text-gray-800 font-bold">Create Pemesanan</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                Logout
            </button>
        </form>
    </div>

    <form action="{{ route('detailpemesanan.store') }}" method="POST" id="dynamic-form" class="w-full flex gap-6 mt-6"
        onsubmit="updateHarga()">
        @csrf
        <div id="dynamic-container" class="w-3/4 flex flex-col">
            <div class="card bg-white p-6 rounded-lg shadow-md space-y-4 w-full mt-4 mr-4 mb-4">
                <h1 class="font-bold uppercase">Ticket 1</h1>
                <div>
                    <label for="id_kursi_plane_1" class="block text-sm font-medium text-gray-700">Kursi plane</label>
                    <select name="pemesanan[1][id_kursi_plane]" id="id_kursi_plane_1" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($kursiplane as $item)
                            <option value="{{ $item->id_kursi_plane }}">
                                {{ $item->nomor_kursi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="nama_penumpang_1" class="block text-sm font-medium text-gray-700">Nama Penumpang</label>
                    <input required type="text" name="pemesanan[1][nama_penumpang]" id="nama_penumpang_1"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="nomor_identitas_1" class="block text-sm font-medium text-gray-700">Nomor
                        Identitas</label>
                    <input required type="text" name="pemesanan[1][nomor_identitas]" id="nomor_identitas_1"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="harga_kursi_1" class="block text-sm font-medium text-gray-700">Harga Kursi</label>
                    <input required type="text" name="pemesanan[1][harga_kursi]" id="harga_kursi_1"
                        value="{{ $jadwal->harga }}" readonly
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <input type="hidden" name="pemesanan[1][id_pemesanan]" value="{{ $id_pemesanan }}">
            </div>
        </div>
        <div class="flex flex-col text-center justify-between items-center h-fit mt-4 gap-4 w-1/4">
            <div class="input flex w-full justify-between items-center bg-white shadow-lg p-4">
                <button type="button" id="add-form"
                    class="font-bold w-10 aspect-square flex justify-center items-center text-white bg-sky-600 rounded-full hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <p id="total-kursi-display"></p>
                <button type="button" id="remove-form"
                    class="w-10 aspect-square font-bold flex justify-center items-center px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1">
                    <i class="fa-solid fa-minus"></i>
                </button>
            </div>
            <div>
                <label for="total-harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
                <input type="text" id="total-harga-display-second" name="total_harga" readonly
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <input type="hidden" value="{{ $id_pengguna }}" name="id_pengguna">
            <button type="submit"
                class="w-fit font-bold px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Simpan
            </button>
        </div>
    </form>

    <form action="{{ route('pemesanan.cancel', $id_pemesanan) }}" method="POST" class="fixed bottom-0 right-0 m-5">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="w-fit font-bold px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
            Back
        </button>
    </form>
    <script>
        let formCount = 1;
        const hargaKursi = parseFloat("{{ $jadwal->harga }}");

        const totalKursiDisplay = document.querySelector('#total-kursi-display');
        const totalHargaDisplaySecond = document.querySelector('#total-harga-display-second');

        function updateTotalKursi() {
            totalKursiDisplay.textContent = formCount;
        }

        function updateHarga() {
            let totalHarga = 0;
            const hargaInputs = document.querySelectorAll('#dynamic-container [name$="[harga_kursi]"]');
            hargaInputs.forEach(input => {
                totalHarga += parseFloat(input.value) || 0;
            });
            totalHargaDisplaySecond.value = totalHarga.toFixed(2);
        }

        document.getElementById('add-form').addEventListener('click', function() {
            formCount++;
            const container = document.getElementById('dynamic-container');
            const newForm = document.createElement('div');
            newForm.className = 'card bg-white p-6 rounded-lg shadow-md space-y-4 w-full mt-4 mr-4 mb-4';
            newForm.innerHTML = `
                <h1 class="font-bold uppercase">Ticket ${formCount}</h1>
                <div>
                    <label for="id_kursi_plane_${formCount}" class="block text-sm font-medium text-gray-700">Kursi plane</label>
                    <select name="pemesanan[${formCount}][id_kursi_plane]" id="id_kursi_plane_${formCount}" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($kursiplane as $item)
                            <option value="{{ $item->id_kursi_plane }}">{{ $item->nomor_kursi }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="nama_penumpang_${formCount}" class="block text-sm font-medium text-gray-700">Nama Penumpang</label>
                    <input required type="text" name="pemesanan[${formCount}][nama_penumpang]" id="nama_penumpang_${formCount}"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="nomor_identitas_${formCount}" class="block text-sm font-medium text-gray-700">Nomor Identitas</label>
                    <input required type="text" name="pemesanan[${formCount}][nomor_identitas]" id="nomor_identitas_${formCount}"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="harga_kursi_${formCount}" class="block text-sm font-medium text-gray-700">Harga Kursi</label>
                    <input required type="text" name="pemesanan[${formCount}][harga_kursi]" id="harga_kursi_${formCount}" value="${hargaKursi}" readonly
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <input type="hidden" name="pemesanan[${formCount}][id_pemesanan]" value="{{ $id_pemesanan }}">
            `;
            container.appendChild(newForm);
            updateTotalKursi();
            updateHarga();
        });

        document.getElementById('remove-form').addEventListener('click', function() {
            if (formCount > 1) {
                const lastForm = document.querySelector(`#dynamic-container .card:last-child`);
                if (lastForm) {
                    lastForm.remove();
                    formCount--;
                    updateTotalKursi();
                    updateHarga();
                }
            }
        });

        updateTotalKursi();
        updateHarga();
    </script>
</x-admin-layout>
