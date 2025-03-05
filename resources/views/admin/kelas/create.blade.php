<form action="{{ route('kelas.store') }}" method="POST"
    class="bg-white p-6 rounded-lg shadow-md space-y-4 w-full mt-4 mr-4 mb-4">
    @csrf
    @method('POST')
    <h1 class="text-gray-800 font-bold">Tambah Kelas</h1>
    <div>
        <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
        <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas') }}" required
            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        @error('nama_kelas')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex text-center justify-between">
        <button type="submit"
            class="w-fit font-bold px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
            Tambah
        </button>
    </div>
</form>
