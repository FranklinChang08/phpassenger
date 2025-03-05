<x-admin-layout>
    <div
        class="nav sticky top-0 left-24 bg-white p-4 rounded-lg mr-4 mt-4 shadow-md flex justify-between items-center z-0">
        <h1 class="text-gray-800 font-bold">Transaction List</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 rounded-md px-4 py-2 text-center text-white font-bold">
                Logout
            </button>
        </form>
    </div>

    <div class="flex items-center gap-6 my-4">
        <form action="{{ route('transaction.index') }}" method="GET" class="flex items-center rounded-lg gap-2">
            <input type="text" name="search" placeholder="Cari transaction...." value="{{ request('search') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-6 py-2 rounded-lg hover:bg-blue-600 hover:text-white font-bold">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <table class="table-auto w-full mt-4 bg-white rounded-lg shadow-md overflow-hidden">
        <thead class="bg-gray-100">
            <tr class="text-center text-nowrap">
                <th class="px-4 py-2 border-b font-bold text-gray-800">No</th>
                <th class="px-4 py-2 border-b font-bold text-gray-800">Name</th>
                <th class="px-4 py-2 border-b font-bold text-gray-800">Tanggal Pembayaran</th>
                <th class="px-4 py-2 border-b font-bold text-gray-800">Rute</th>
                <th class="px-4 py-2 border-b font-bold text-gray-800">Jadwal</th>
                <th class="px-4 py-2 border-b font-bold text-gray-800">Status</th>
                <th class="px-4 py-2 border-b font-bold text-gray-800">Bukti Pembayaran</th>
                <th class="px-4 py-2 border-b font-bold text-gray-800">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($transaction && $transaction->count() > 0)
                @php
                    $no = 1;
                @endphp
                @foreach ($transaction as $data)
                    <tr class="hover:bg-gray-50 text-center text-nowrap">
                        <td class="px-4 py-3 border-b text-gray-700">{{ $no++ }}</td>
                        <td class="px-4 py-3 border-b text-gray-700">{{ $data->nama }}</td>
                        <td class="px-4 py-3 border-b text-gray-700">
                            {{ date('D, d M Y', strtotime($data->tanggal_pembayaran)) }}</td>
                        <td class="px-4 py-3 border-b text-gray-700">{{ $data->asal }} {{ $data->tujuan }}</td>
                        <td class="px-4 py-3 border-b text-gray-700">
                            {{ date('D, d M Y', strtotime($data->tanggal)) }} {{ $data->waktu_berangkat }}
                        </td>
                        <td class="px-4 py-3 border-b text-white">
                            @if ($data->status_pembayaran == 'Pending')
                                <span
                                    class="bg-blue-700/90 border border-blue-700 rounded-full px-2">{{ $data->status_pembayaran }}</span>
                            @endif
                            @if ($data->status_pembayaran == 'Cancelled' || $data->status_pembayaran == 'Refund')
                                <span
                                    class="bg-red-600/90 border border-red-600 rounded-full px-2">{{ $data->status_pembayaran }}</span>
                            @endif
                            @if ($data->status_pembayaran == 'Completed')
                                <span
                                    class="bg-orange-600/90 border border-orange-600 rounded-full px-2">{{ $data->status_pembayaran }}</span>
                            @endif
                            @if ($data->status_pembayaran == 'Confirmed')
                                <span
                                    class="bg-green-600/90 border border-green-600 rounded-full px-2">{{ $data->status_pembayaran }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 border-b text-gray-700">
                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-{{ $data->id_transaction }}"
                                data-modal-toggle="default-modal-{{ $data->id_transaction }}"
                                class="block font-bold rounded-lg text-sm px-5 py-2.5 bg-indigo-200 text-indigo-600 hover:ring-2 hover:ring-indigo-600 hover:bg-indigo-300"
                                type="button">
                                Foto Bukti
                            </button>
                        </td>
                        <td class="px-4 py-3 space-x-4 border-b text-gray-700  flex">
                            @if (!in_array($data->status_pembayaran, ['Pending', 'Cancelled', 'Refund']))
                                <form action="{{ route('transaction.refundAdmin') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id_transaction" value="{{ $data->id_transaction }}">
                                    <button class="relative group">
                                        <i class="fa-regular fa-credit-card text-red-700"></i>
                                        <span
                                            class="hidden group-hover:block text-xs absolute bottom-7 bg-indigo-300 p-1 px-2 font-semibold w-fit text-nowrap rounded-r-full rounded-tl-full">
                                            Refund
                                        </span>
                                    </button>
                                </form>
                            @endif
                            @if ($data->status_pembayaran != 'Confirmed' && $data->status_pembayaran != 'Pending' &&  $data->status_pembayaran != 'Refund')
                                <form action="{{ route('transaction.confirm', $data->id_transaction) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-green-600 hover:text-green-800 font-semibold">
                                        <button class="relative group">
                                            <i class="fa-solid fa-check text-green-600"></i>
                                            <span
                                                class="hidden group-hover:block text-xs absolute bottom-7 bg-indigo-300 p-1 px-2 font-semibold w-fit text-nowrap rounded-r-full rounded-tl-full">
                                                Confirm
                                            </span>
                                        </button>
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('transaction.destroy', $data->id_transaction) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('Yakin ingin menghapus transaction ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                    <button class="relative group">
                                        <i class="fa-regular fa-trash-can text-red-700"></i>
                                        <span
                                            class="hidden group-hover:block text-xs absolute bottom-7 bg-indigo-300 p-1 px-2 font-semibold w-fit text-nowrap rounded-r-full rounded-tl-full">
                                            Delete
                                        </span>
                                    </button>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Main modal -->
                    <div id="default-modal-{{ $data->id_transaction }}" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Foto Bukti Pembayaran
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="default-modal-{{ $data->id_transaction }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">
                                    <img src="{{ asset($data->bukti_pembayaran) }}" alt="">
                                </div>
                                <!-- Modal footer -->
                                <div
                                    class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="default-modal-{{ $data->id_transaction }}" type="button"
                                        class="py-2.5 px-5 ms-3 text-sm font-medium bg-indigo-200 rounded-sm text-indigo-600">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert">
                    <svg class="w-5 h-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.366-.74 1.43-.74 1.796 0l6.348 12.857c.334.675-.126 1.443-.898 1.443H2.807c-.772 0-1.232-.768-.898-1.443L8.257 3.1zM9 13a1 1 0 112 0 1 1 0 01-2 0zm.25-4.75a.75.75 0 10-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium mr-2">Warning:</span>Data Rute tidak tersedia.
                </div>
            @endif
        </tbody>
    </table>
    {{ $transaction->links() }}
</x-admin-layout>
