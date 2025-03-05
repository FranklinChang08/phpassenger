<x-admin-layout>
    <div
        class="nav sticky top-0 left-0 bg-white p-4 rounded-lg mr-4 mt-4  shadow-md flex justify-between items-center z-0">
        <h1 class="text-gray-800 font-bold">Create Pemesanan</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                Logout
            </button>
        </form>
    </div>
    <form action="{{ route('pemesanan.store') }}" method="POST"
        class="bg-white p-6 rounded-lg shadow-md space-y-4 w-full mt-4 mr-4 mb-4">
        @csrf
        @method('POST')
        <h1 class="text-gray-800 font-bold">Tambah Pemesanan</h1>

        <div>
            <label for="id_pengguna" class="block text-sm font-medium text-gray-700">Pengguna</label>
            <select name="id_pengguna" id="id_pengguna" required
                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach ($pengguna as $item)
                    @if ($item->role == 'Penumpang')
                        <option value="{{ $item->id_pengguna }}"
                            {{ old('id_pengguna') == $item->id_pengguna ? 'selected' : '' }}>{{ $item->nama }} -
                            {{ $item->email }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="relative">
            <label for="id_jadwal" class="block text-sm font-medium text-gray-700">Jadwal</label>
            <input type="text" id="search-input"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Search Jadwal..." autocomplete="off" />
            <input type="hidden" name="id_jadwal" id="selected-value" />

            <!-- Dropdown List -->
            <ul id="dropdown-list"
                class="absolute mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto hidden">
                @foreach ($jadwal as $item)
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                        data-value="{{ $item->id_jadwal }},{{ $item->id_kelas }}, {{ $item->tanggal }}">
                        {{ $item->tujuan }} ({{ $item->tanggal }}) - <span class="font-bold">{{ $item->nama_kelas }}</span> -  Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex text-center justify-between">
            <button type="submit"
                class="w-fit font-bold px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Lanjut
            </button>
            <a href="{{ route('pemesanan.index') }}"
                class="w-fit font-bold px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                Back
            </a>
        </div>
    </form>

    <script>
        const searchInput = document.getElementById('search-input');
        const dropdownList = document.getElementById('dropdown-list');
        const selectedValueInput = document.getElementById('selected-value');

        // Show and filter dropdown options
        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const options = dropdownList.querySelectorAll('li');

            let hasVisibleOptions = false;

            options.forEach(option => {
                if (option.textContent.toLowerCase().includes(filter)) {
                    option.style.display = '';
                    hasVisibleOptions = true;
                } else {
                    option.style.display = 'none';
                }
            });

            if (hasVisibleOptions) {
                dropdownList.classList.add('block');
                dropdownList.classList.remove('hidden');
            } else {
                dropdownList.classList.add('hidden');
                dropdownList.classList.remove('block');
            }
        });

        // Handle option selection
        dropdownList.addEventListener('click', function(e) {
            if (e.target.tagName === 'LI') {
                searchInput.value = e.target.textContent; // Set the display value
                selectedValueInput.value = e.target.getAttribute('data-value'); // Set the actual value
                dropdownList.classList.add('hidden'); // Hide the dropdown
                dropdownList.classList.remove('block');
            }
        });

        // Hide dropdown on outside click
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative')) {
                dropdownList.classList.add('hidden');
                dropdownList.classList.remove('block');
            }
        });
    </script>

</x-admin-layout>
