<x-admin-layout>
    <div
        class="nav sticky top-0 left-0 bg-white p-4 rounded-lg mr-4 mt-4  shadow-md flex justify-between items-center z-0">
        <h1 class="text-gray-800 font-bold">Create Jadwal</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                Logout
            </button>
        </form>
    </div>
    <form action="{{ route('jadwal.store') }}" method="POST"
        class="bg-white p-6 rounded-lg shadow-md space-y-4 w-full mt-4 mr-4 mb-4">
        @csrf
        @method('POST')
        <h1 class="text-gray-800 font-bold">Tambah Jadwal</h1>

        <!-- ID plane Rute -->
        <div>
            <label for="id_plane_rute" class="block text-sm font-medium text-gray-700">Plane Rute</label>
            <select name="id_plane_rute" id="id_plane_rute" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach ($planerute as $item)
                    <option value="{{ $item->id_plane_rute }}"
                        {{ old('id_plane_rute') == $item->id_plane_rute ? 'selected' : '' }}>
                        {{ $item->nama_maskapai }} {{ $item->nomor_penerbangan }} <span class="font-bold">({{ $item->asal }} -
                            {{ $item->tujuan }})</span></option>
                @endforeach
            </select>
            @error('id_plane_rute')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tanggal -->
        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('tanggal')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Waktu Berangkat -->
        <div>
            <label for="waktu_berangkat" class="block text-sm font-medium text-gray-700">Waktu Berangkat</label>
            <input type="time" name="waktu_berangkat" id="waktu_berangkat" value="{{ old('waktu_berangkat') }}"
                required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('waktu_berangkat')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Waktu Tiba -->
        <div>
            <label for="waktu_tiba" class="block text-sm font-medium text-gray-700">Waktu Tiba</label>
            <input type="time" name="waktu_tiba" id="waktu_tiba" value="{{ old('waktu_tiba') }}" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('waktu_tiba')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex text-center justify-between">
            <button type="submit"
                class="w-fit font-bold px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Tambah
            </button>
            <a href="{{ route('jadwal.index') }}"
                class="w-fit font-bold px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Back
            </a>
        </div>
    </form>

</x-admin-layout>
