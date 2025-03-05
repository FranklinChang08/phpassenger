<x-admin-layout>
    <div
        class="nav sticky top-0 left-0 bg-white p-4 rounded-lg mr-4 mt-4 shadow-md flex justify-between items-center z-0">
        <h1 class="text-gray-800 font-bold">Edit Plane</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                Logout
            </button>
        </form>
    </div>
    <form action="{{ route('plane.update', $plane->id_plane) }}" method="POST"
        class="bg-white p-6 rounded-lg shadow-md space-y-4 w-full mt-4 mr-4 mx-auto">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_maskapai" class="block text-sm font-medium text-gray-700">Nama Maskapai</label>
            <input type="text" name="nama_maskapai" id="nama_maskapai"
                value="{{ old('nama_maskapai', $plane->nama_maskapai) }}" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('nama_maskapai')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="nomor_regis" class="block text-sm font-medium text-gray-700">Nomor Register</label>
            <input type="text" name="nomor_regis" id="nomor_regis"
                value="{{ old('nomor_regis', $plane->nomor_regis) }}"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('nomor_regis')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="nomor_penerbangan" class="block text-sm font-medium text-gray-700">Nomor Penerbangan</label>
            <input type="text" name="nomor_penerbangan" id="nomor_penerbangan"
                value="{{ old('nomor_penerbangan', $plane->nomor_penerbangan) }}"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('nomor_penerbangan')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="kapasitas" class="block text-sm font-medium text-gray-700">Kapasitas</label>
            <input type="text" name="kapasitas" id="kapasitas" value="{{ old('kapasitas', $plane->kapasitas) }}"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('kapasitas')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
            <select name="kelas[]" id="kelas" multiple="multiple"
                class="js-example-basic-multiple mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach ($kelas as $item)
                    <option value="{{ $item->id_kelas }}">{{ $item->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex text-center justify-between">
            <button type="submit"
                class="w-fit font-bold px-4 py-2 text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Edit
            </button>
            <a href="{{ route('plane.index') }}"
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
            $('.js-example-basic-multiple').select2();
        });
    </script>
</x-admin-layout>
