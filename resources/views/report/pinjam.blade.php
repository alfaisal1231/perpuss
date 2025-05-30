<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('trsPinjam') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 py-4 flex justify-between items-center">
                    <div>Data trsPinjam</div>
                    <button onclick="return filterData()">Filter trsPinjam</button>
                </div>
                <div class="px-6 text-gray-900 dark:text-gray-100 mb-4">
                    <table id="myDataTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi Pinjam</th>
                                <th>Kode Anggota</th>
                                <th>Anggota</th>
                                <th>Tanggal Pinjam</th>
                                <th>Batas Pinjam</th>
                                <th>Kode Koleksi</th>
                                <th>Judul</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @if ($data->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center text-gray-500">Silakan pilih rentang tanggal
                                        terlebih dahulu</td>
                                </tr>
                            @else
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $d->no_transaksi_pinjam }}</td>
                                        <td>{{ $d->kd_anggota }}</td>
                                        <td>{{ $d->anggota->nm_anggota }}</td>
                                        <td>{{ $d->tg_pinjam }}</td>
                                        <td>{{ $d->tgl_bts_kembali }}</td>
                                        <td>{{ $d->kd_koleksi }}</td>
                                        <td>{{ $d->koleksi->judul }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL FILTER DATA --}}
    <div id="modal-filterData" class="hidden fixed inset-0 flex justify-center items-center m-4">
        <div class="bg-white rounded-lg p-6 lg:w-4/12 w-full shadow-xl">
            <h2 class="text-lg font-bold mb-4 bg-amber-100 p-2 rounded-xl">Filter trsPinjam</h2>
            <form id="filterForm" action="{{ route('reportPinjam.index') }}" method="get" class="w-full">
                @csrf
                <p id="modal-content"></p>
                <button type="submit" id="submitFilter" class="mt-4 bg-sky-500 text-white px-4 py-2 rounded">
                    Simpan
                </button>
                <button type="button" onclick="closeModalFilter(event)"
                    class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
                    Tutup
                </button>
            </form>
        </div>
    </div>

    {{-- SCRIPT FILTER FILTER --}}
    <script>
        function filterData() {
            const modalContent = document.getElementById("modal-content");
            modalContent.innerHTML = `
                <div class="lg:mb-5 mb-2 w-full">
                    <label for="dari" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dari</label>
                    <input type="date" id="dari" name="dari" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" />
                </div>
                <div class="lg:mb-5 mb-2 w-full">
                    <label for="sampai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sampai</label>
                    <input type="date" id="sampai" name="sampai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value=""/>
                </div>
            `;
            const modal = document.getElementById("modal-filterData");
            modal.classList.remove("hidden");
        }

        function closeModalFilter() {
            const modal = document.getElementById("modal-filterData");
            modal.classList.add("hidden");
        }
    </script>

</x-app-layout>
