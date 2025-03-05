<x-admin-layout>
    <div class="planeruteList">
        <div
            class="nav sticky top-0 left-0 bg-white p-4 rounded-lg mr-4 mt-4 shadow-md flex justify-between items-center z-10">
            <h1 class="text-gray-800 font-bold">Plane Rute List</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                    Logout
                </button>
            </form>
        </div>

        <div class="flex items-center gap-6 my-4">
            <button onclick="togglePartial()" class="font-bold bg-blue-600 px-4 py-2 rounded-md text-white">Tambah
                Form</button>
            <form action="{{ route('planerute.index') }}" method="GET" class="flex items-center rounded-lg gap-2">
                <select name="id_rute" id="id_rute" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($rute as $item)
                        <option value="{{ $item->id_rute }}" {{ old('id_rute') == $item->id_rute ? 'selected' : '' }}>
                            {{ $item->asal }} - {{ $item->tujuan }} - {{ $item->jarak_km }} Km</option>
                    @endforeach
                </select>

                <select name="id_plane" id="id_plane" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($plane as $item)
                        <option value="{{ $item->id_plane }}"
                            {{ old('id_plane') == $item->id_plane ? 'selected' : '' }}>
                            {{ $item->nama_maskapai }} - {{ $item->nomor_penerbangan }} - {{ $item->kapasitas }} Orang
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="px-6 py-2 rounded-lg hover:bg-blue-600 hover:text-white font-bold">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div id="partial-container" style="display: none;">
            @include('admin.planerute.create')
        </div>
        <table class="table-auto w-full mt-4 bg-white rounded-lg shadow-md overflow-hidden">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Id</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Nama plane</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Plat Nomor</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Asal</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Tujuan</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Jarak KM</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Kapasitas</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($planerute && $planerute->count() > 0)
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($planerute as $data)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 border-b text-gray-700">{{ $no++ }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">{{ $data->nama_maskapai }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">{{ $data->nomor_penerbangan }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">{{ $data->asal }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">{{ $data->tujuan }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">{{ $data->jarak_km }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">{{ $data->kapasitas }} Orang</td>
                            <td class="px-4 py-3 border-b text-gray-700">
                                <a href="{{ route('planerute.show', $data->id_plane_rute) }}"
                                    class="text-blue-600 hover:text-blue-800 font-semibold mr-3">
                                    Edit
                                </a>
                                <form action="{{ route('planerute.destroy', $data->id_plane_rute) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus plane Rute ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <div class="flex items-center p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
                        <svg class="w-5 h-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.366-.74 1.43-.74 1.796 0l6.348 12.857c.334.675-.126 1.443-.898 1.443H2.807c-.772 0-1.232-.768-.898-1.443L8.257 3.1zM9 13a1 1 0 112 0 1 1 0 01-2 0zm.25-4.75a.75.75 0 10-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium mr-2">Warning:</span>Data plane Rute tidak tersedia.
                    </div>
                @endif
            </tbody>
        </table>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.select-rute').select2();
                $('.select-plane').select2();
            });
        </script>
    </div>
</x-admin-layout>
