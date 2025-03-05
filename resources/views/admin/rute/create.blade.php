<x-admin-layout>
    <div
        class="nav sticky top-0 left-0 bg-white p-4 rounded-lg mr-4 mt-4 shadow-md flex justify-between items-center z-0">
        <h1 class="text-gray-800 font-bold">Create Rute</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                Logout
            </button>
        </form>
    </div>

    <form action="{{ route('rute.store') }}" method="POST"
        class="bg-white p-6 rounded-lg shadow-md space-y-4 w-full mt-4 mr-4 mx-auto">
        @csrf
        @method('POST')

        <div>
            <label for="asal" class="block text-sm font-medium text-gray-700">Asal</label>
            <input type="text" name="asal" id="asal" value="{{ old('asal') }}" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('asal')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="tujuan" class="block text-sm font-medium text-gray-700">Tujuan</label>
            <input type="text" name="tujuan" id="tujuan" value="{{ old('tujuan') }}"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('tujuan')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="jarak_km" class="block text-sm font-medium text-gray-700">Jarak KM</label>
            <input type="text" name="jarak_km" id="jarak_km" value="{{ old('jarak_km') }}"
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('jarak_km')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex text-center justify-between">
            <button type="submit"
                class="w-fit font-bold px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Tambah
            </button>
            <a href="{{ route('rute.index') }}"
                class="w-fit font-bold px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Back
            </a>
        </div>
    </form>
</x-admin-layout>
