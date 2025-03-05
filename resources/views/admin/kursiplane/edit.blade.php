<x-admin-layout>
    <div
        class="nav sticky top-0 left-0 bg-white p-4 rounded-lg mr-4 mt-4  shadow-md flex justify-between items-center z-0">
        <h1 class="text-gray-800 font-bold">Edit Kursi Plane</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                Logout
            </button>
        </form>
    </div>
    <form action="{{ route('kursiplane.update', $kursiplane->id_kursi_plane) }}" method="POST"
        class="bg-white p-6 rounded-lg shadow-md space-y-4 w-full mt-4 mr-4 mb-4">
        @csrf
        @method('PUT')
        <h1 class="text-gray-800 font-bold">Tambah Kursi plane</h1>

        <div>
            <label for="id_plane" class="block text-sm font-medium text-gray-700">plane</label>
            <select name="id_plane" id="id_plane" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach ($plane as $item)
                    <option value="{{ $item->id_plane }}" data-kursi="{{ $item->kapasitas }}"
                        {{ $kursiplane->id_plane == $item->id_plane ? 'selected' : '' }}>
                        {{ $item->nama_maskapai }} - {{ $item->nomor_penerbangan }} -
                        {{ $item->kapasitas }} Orang
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
            <select name="id_kelas" id="id_kelas" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach ($kelas as $item)
                    <option value="{{ $item->id_kelas }}"
                        {{ $kursiplane->id_kelas == $item->id_kelas ? 'selected' : '' }}>
                        {{ $item->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="nomor_kursi" class="block text-sm font-medium text-gray-700">Nomor Kursi</label>
            <input type="text" name="nomor_kursi" id="nomor_kursi" value="{{ $kursiplane->nomor_kursi }}"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Kelas</label>
            <select name="status" id="status" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="Available" {{ $kursiplane->status == 'Available' ? 'selected' : '' }}>Available
                </option>
                <option value="Booked" {{ $kursiplane->status == 'Booked' ? 'selected' : '' }}>Booked</option>
            </select>
        </div>

        <div class="flex text-center justify-between">
            <button type="submit"
                class="w-fit font-bold px-4 py-2 text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Edit
            </button> <a href="{{ route('kursiplane.index') }}"
                class="w-fit font-bold px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Back
            </a>
        </div>
    </form>

</x-admin-layout>
