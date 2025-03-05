<form action="{{ route('planerute.store') }}" method="POST"
    class="bg-white p-6 rounded-lg shadow-md space-y-4 w-fit mt-4 mr-4 mb-4">
    @csrf
    @method('POST')
    <h1 class="text-gray-800 font-bold">Tambah Plane Rute</h1>
    <div>
        <label for="id_rute" class="block text-sm font-medium text-gray-700">Rute</label>
        <select name="id_rute" id="id_rute" required
            class="select-rute mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @foreach ($rute as $item)
                <option value="{{ $item->id_rute }}" {{ old('id_rute') == $item->id_rute ? 'selected' : '' }}>
                    {{ $item->asal }} - {{ $item->tujuan }} - {{ $item->jarak_km }} Km</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="id_plane" class="block text-sm font-medium text-gray-700">plane</label>
        <select name="id_plane" id="id_plane" required
            class="select-plane custom-select mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @foreach ($plane as $item)
                <option value="{{ $item->id_plane }}" {{ old('id_plane') == $item->id_plane ? 'selected' : '' }}>
                    {{ $item->nama_maskapai }} - {{ $item->nomor_penerbangan }} - {{ $item->kapasitas }} Orang</option>
            @endforeach
        </select>
    </div>

    <div class="flex text-center justify-between">
        <button type="submit"
            class="w-fit font-bold px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
            Tambah
        </button>
    </div>
</form>
