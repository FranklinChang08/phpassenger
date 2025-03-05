<x-admin-layout>
    <div
        class="nav sticky top-0 left-0 bg-white p-4 rounded-lg mr-4 mt-4  shadow-md flex justify-between items-center z-0">
        <h1 class="text-gray-800 font-bold">Edit Pemesanan</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                Logout
            </button>
        </form>
    </div>
    <form action="{{ route('pemesanan.update', $pemesanan->id_pemesanan) }}" method="POST"
        class="bg-white p-6 rounded-lg shadow-md space-y-4 w-full mt-4 mr-4 mb-4">
        @csrf
        @method('PUT')
        <h1 class="text-gray-800 font-bold">Edit Pemesanan</h1>

        <div>
            <label for="id_pengguna" class="block text-sm font-medium text-gray-700">Pengguna</label>
            <select name="id_pengguna" id="id_pengguna" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach ($pengguna as $item)
                    <option value="{{ $item->id_pengguna }}"
                        {{ $pemesanan->id_pengguna == $item->id_pengguna ? 'selected' : '' }}>{{ $item->nama }}
                        -
                        {{ $item->email }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_jadwal" class="block text-sm font-medium text-gray-700">Jadwal</label>
            <select name="id_jadwal" id="id_jadwal" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach ($jadwal as $item)
                    <option value="{{ $item->id_jadwal }}"
                        {{ $pemesanan->id_jadwal == $item->id_jadwal ? 'selected' : '' }}>
                        {{ $item->plat_nomor }} - {{ $item->tujuan }} - {{ $item->tanggal }}
                        ({{ $item->waktu_berangkat }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="id_kursi_bus" class="block text-sm font-medium text-gray-700">Kursi Bus</label>
            <select name="id_kursi_bus" id="id_kursi_bus" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach ($kursibus as $item)
                    <option value="{{ $item->id_kursi_bus }}"
                        {{ $detail_pemesanan->id_kursi_bus == $item->id_kursi_bus ? 'selected' : '' }}>
                        {{ $item->nomor_kursi }} - {{ $item->nama_kelas }} - {{ $item->status }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="nomor_identitas" class="block text-sm font-medium text-gray-700">Nomor Identitas</label>
            <input required type="text" name="nomor_identitas" id="nomor_identitas"
                value="{{ old('nomor_identitas', $detail_pemesanan->nomor_identitas) }}"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="harga_kursi" class="block text-sm font-medium text-gray-700">Harga Kursi</label>
            <input required type="text" name="harga_kursi" id="harga_kursi"
                value="{{ old('harga_kursi', $detail_pemesanan->harga_kursi) }}"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="total_harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
            <input required type="text" name="total_harga" id="total_harga"
                value="{{ old('total_harga', $detail_pemesanan->total_harga) }}"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="flex text-center justify-between">
            <button type="submit"
                class="w-fit font-bold px-4 py-2 text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Edit
            </button>
            <a href="{{ route('pemesanan.index') }}"
                class="w-fit font-bold px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Back
            </a>
        </div>
    </form>

</x-admin-layout>
