<x-admin-layout>

    <div
        class="nav sticky top-0 left-0 bg-white p-4 rounded-lg mr-4 mt-4  shadow-md flex justify-between items-center z-0">
        <h1 class="text-gray-800 font-bold">Edit plane Rute</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                Logout
            </button>
        </form>
    </div>

    <form action="{{ route('planerute.update', $planerute->id_plane_rute) }}" method="POST"
        class="bg-white p-6 rounded-lg shadow-md space-y-4 w-full mt-4 mr-4 mb-4">
        @csrf
        @method('PUT')
        <h1 class="text-gray-800 font-bold">Tambah Kelas</h1>
        <div>
            <label for="id_rute" class="block text-sm font-medium text-gray-700">Rute</label>
            <select name="id_rute" id="id_rute" required
                class=".select-rute-edit mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach ($rute as $item)
                    <option value="{{ $item->id_rute }}" {{ $planerute->id_rute == $item->id_rute ? 'selected' : '' }}>
                        {{ $item->asal }} - {{ $item->tujuan }} - {{ $item->jarak_km }} Km</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_plane" class="block text-sm font-medium text-gray-700">plane</label>
            <select name="id_plane" id="id_plane" required
                class=".select-plane-edit mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach ($plane as $item)
                    <option value="{{ $item->id_plane }}"
                        {{ $planerute->id_plane == $item->id_plane ? 'selected' : '' }}>
                        {{ $item->nama_maskapai }} - {{ $item->nomor_penerbangan }} - {{ $item->kapasitas }} Orang
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex text-center justify-between">
            <button type="submit"
                class="w-fit font-bold px-4 py-2 text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Edit
            </button>
            <a href="{{ route('planerute.index') }}"
                class="w-fit font-bold px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Back
            </a>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-rute-edit').select2();
            $('.select-plane-edit').select2();
        });
    </script>
</x-admin-layout>
