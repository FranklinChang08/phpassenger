<form action="{{ route('harga.store') }}" method="POST"
    class="bg-white p-6 rounded-lg shadow-md space-y-4 w-full mt-4 mr-4 mb-4">
    @csrf
    @method('POST')
    <h1 class="text-gray-800 font-bold">Tambah Data</h1>
    <div>
        <label for="id_rute" class="block text-sm font-medium text-gray-700">Rute</label>
        <select name="id_rute" id="id_rute" required
            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @foreach ($rute as $item)
                <option value="{{ $item->id_rute }}" {{ old('id_rute') == $item->id_rute ? 'selected' : '' }}>
                    {{ $item->asal }} - {{ $item->tujuan }} - {{ $item->jarak_km }} Km</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="id_kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
        <select name="id_kelas" id="id_kelas" required
            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @foreach ($kelas as $item)
                <option value="{{ $item->id_kelas }}" {{ old('id_kelas') == $item->id_kelas ? 'selected' : '' }}>
                    {{ $item->nama_kelas }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
        <input type="number" name="harga" id="harga" value="{{ old('harga') }}" required
            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    </div>

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
