<x-admin-layout>
    <div class="kursiplaneList mb-24">
        <div
            class="nav sticky top-0 left-0 bg-white p-4 rounded-lg mr-4 mt-4 shadow-md flex justify-between items-center z-10">
            <h1 class="text-gray-800 font-bold">Kursi Plane List</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                    Logout
                </button>
            </form>
        </div>

        <div class="flex items-center gap-6 my-4">
            <a href="{{ route('kursiplane.create') }}"
                class="font-bold bg-blue-600 px-4 py-2 rounded-md text-white">Tambah
                Form</a>
            <form action="{{ route('kursiplane.index') }}" method="GET" class="flex items-center rounded-lg gap-2">
                <input type="text" name="search" placeholder="Cari plane Rute..." value="{{ request('search') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="px-6 py-2 rounded-lg hover:bg-blue-600 hover:text-white font-bold">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        <table class="table-auto w-full mt-4 bg-white rounded-lg shadow-md overflow-hidden">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Id</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Nama plane</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Nomor Penerbangan</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Nomor Kursi</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Kelas</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Status</th>
                    <th class="px-4 py-2 border-b font-bold text-gray-800">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($kursiplane && $kursiplane->count() > 0)
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($kursiplane as $data)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 border-b text-gray-700">{{ $no++ }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">{{ $data->nama_maskapai }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">{{ $data->nomor_penerbangan }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">{{ $data->nomor_kursi }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">{{ $data->nama_kelas }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">{{ $data->status }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">
                                <a href="{{ route('kursiplane.show', $data->id_kursi_plane) }}"
                                    class="text-blue-600 hover:text-blue-800 font-semibold mr-3">
                                    Edit
                                </a>
                                <form action="{{ route('kursiplane.destroy', $data->id_kursi_plane) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus Kursi plane ini?')">
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

        <div class="mt-4">
            {{ $kursiplane->links() }}
        </div>
    </div>
</x-admin-layout>
