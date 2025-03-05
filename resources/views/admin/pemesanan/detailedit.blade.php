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

    <form action="{{ route('detailpemesanan.update', $detailpemesanan->id_detail_pemesanan) }}" method="POST"
        id="dynamic-form" class="w-full flex gap-6 mt-6">
        @csrf
        @method('PUT')
        <div id="dynamic-container" class="w-3/4 flex flex-col">
            <div class="card bg-white p-6 rounded-lg shadow-md space-y-4 w-full mt-4 mr-4 mb-4">
                <h1 class="font-bold uppercase">Ticket 1</h1>
                <div>
                    <label for="id_kursi_plane_1" class="block text-sm font-medium text-gray-700">Kursi plane</label>
                    <select name="id_kursi_plane" id="id_kursi_plane_1" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($kursiplane as $item)
                            <option value="{{ $item->id_kursi_plane }}"
                                {{ $detailpemesanan->id_kursi_plane == $item->id_kursi_plane ? 'selected' : '' }}>
                                {{ $item->nomor_kursi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="nama_penumpang_1" class="block text-sm font-medium text-gray-700">Nama Penumpang</label>
                    <input required type="text" name="nama_penumpang" id="nama_penumpang_1"
                        value="{{ $detailpemesanan->nama_penumpang }}"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('nama_penumpang')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="nomor_identitas_1" class="block text-sm font-medium text-gray-700">Nomor
                        Identitas</label>
                    <input required type="text" name="nomor_identitas" id="nomor_identitas_1"
                        value="{{ $detailpemesanan->nomor_identitas }}"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('nomor_identitas')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button type="submit"
                class="w-fit font-bold px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Simpan
            </button>
        </div>
    </form>

</x-admin-layout>
