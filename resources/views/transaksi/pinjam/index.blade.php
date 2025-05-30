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
                    <button onclick="return addData()">Tambah trsPinjam</button>
                </div>
                <div class="px-6 text-gray-900 dark:text-gray-100">
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @forelse ($data as $d)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $d->no_transaksi_pinjam }}</td>
                                    <td>{{ $d->kd_anggota }}</td>
                                    <td>{{ $d->anggota->nm_anggota }}</td>
                                    <td>{{ $d->tg_pinjam }}</td>
                                    <td>{{ $d->tgl_bts_kembali }}</td>
                                    <td>{{ $d->kd_koleksi }}</td>
                                    <td>{{ $d->koleksi->judul }}</td>
                                    <td>
                                        <button
                                            onclick="return updateData('{{ $d->id }}','{{ $d->kd_anggota }}','{{ $d->tg_pinjam }}','{{ $d->tgl_bts_kembali }}','{{ $d->kd_koleksi }}','{{ route('trsPinjam.update', $d->id) }}')">Edit</button>
                                        <button
                                            onclick="return deleteData('{{ $d->id }}','{{ $d->no_transaksi_pinjam }}', '{{ route('trsPinjam.destroy', $d->id) }}')">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Data Not Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL ADD DATA --}}
    <div id="modal-addData" class="hidden fixed inset-0 flex justify-center items-center m-4">
        <div class="bg-white rounded-lg p-6 lg:w-4/12 w-full shadow-xl">
            <h2 class="text-lg font-bold mb-4 bg-amber-100 p-2 rounded-xl">Add trsPinjam</h2>
            <form id="addForm" action="{{ route('trsPinjam.store') }}" method="post" class="w-full">
                @csrf
                <p id="modal-content"></p>
                <button type="submit" id="submitAdd" class="mt-4 bg-sky-500 text-white px-4 py-2 rounded">
                    Simpan
                </button>
                <button type="button" onclick="closeModalAdd(event)"
                    class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
                    Tutup
                </button>
            </form>
        </div>
    </div>

    {{-- MODAL UPDATE DATA --}}
    <div id="modal-updateData" class="hidden fixed inset-0 flex justify-center items-center m-4">
        <div class="bg-white rounded-lg p-6 lg:w-4/12 w-full shadow-xl">
            <h2 class="text-lg font-bold mb-4 bg-amber-100 p-2 rounded-xl">Update trsPinjam</h2>
            <form id="updateForm" action="" method="post" class="w-full">
                @csrf
                @method('PATCH')
                <p id="modal-content-update"></p>
                <button type="submit" id="submitUpdate" class="mt-4 bg-sky-500 text-white px-4 py-2 rounded">
                    Simpan
                </button>
                <button type="button" onclick="closeModalUpdate(event)"
                    class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
                    Tutup
                </button>
            </form>
        </div>
    </div>

    {{-- MODAL DELETE DATA --}}
    <div id="modal-deleteData" class="hidden fixed inset-0 flex justify-center items-center m-4 bg-black/30 z-50">
        <div class="bg-white rounded-lg p-6 lg:w-4/12 w-full shadow-xl">
            <h2 class="text-lg font-bold mb-4 text-red-600">Konfirmasi Hapus</h2>
            <form id="deleteForm" action="" method="post" class="w-full">
                @csrf
                @method('DELETE')
                <p id="delete-message" class="mb-4 text-gray-800"></p>
                <div class="flex justify-end gap-2">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Hapus</button>
                    <button type="button" onclick="closeModalDelete()"
                        class="bg-gray-400 text-white px-4 py-2 rounded">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT MODAL ADD --}}
    <script>
        function addData() {
            const modalContent = document.getElementById("modal-content");
            modalContent.innerHTML = `
                <div class="lg:mb-5 mb-2 w-full">
                    <label for="kd_anggota" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Anggota <span class="text-red-500">*</span></label>
                    <select id="kd_anggota" class="form-control lg:w-[387px] w-[280px]" name="kd_anggota"data-placeholder="Pilih Anggota">
                        <option value="">Pilih...</option>
                        @foreach ($anggota as $a)
                            <option value="{{ $a->kd_anggota }}">{{ $a->nm_anggota }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="lg:mb-5 mb-2 w-full">
                    <label for="tgl_pinjam" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pinjam</label>
                    <input type="date" id="tgl_pinjam" name="tgl_pinjam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" />
                </div>
                <div class="lg:mb-5 mb-2 w-full">
                    <label for="tgl_bts_kembali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Batas Kembali</label>
                    <input type="date" id="tgl_bts_kembali" name="tgl_bts_kembali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value=""/>
                </div>
                <div class="lg:mb-5 mb-2 w-full">
                    <label for="kd_koleksi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Koleksi <span class="text-red-500">*</span></label>
                    <select id="kd_koleksi" class="form-control lg:w-[387px] w-[280px]" name="kd_koleksi"data-placeholder="Pilih Koleksi">
                        <option value="">Pilih...</option>
                        @foreach ($koleksi as $k)
                            <option value="{{ $k->kd_koleksi }}">{{ $k->judul }}</option>
                        @endforeach
                    </select>
                </div>
            `;
            const modal = document.getElementById("modal-addData");
            modal.classList.remove("hidden");

            const maxBatasPinjam = @json($max_wkt_pjm);
            const inputTglPinjam = document.getElementById('tgl_pinjam');
            const inputTglBtsKembali = document.getElementById('tgl_bts_kembali');

            inputTglPinjam.addEventListener('change', function() {
                const tglPinjam = new Date(this.value);
                if (isNaN(tglPinjam)) return;

                tglPinjam.setDate(tglPinjam.getDate() + maxBatasPinjam);

                const yyyy = tglPinjam.getFullYear();
                const mm = String(tglPinjam.getMonth() + 1).padStart(2, '0');
                const dd = String(tglPinjam.getDate()).padStart(2, '0');
                const formattedDate = `${yyyy}-${mm}-${dd}`;

                inputTglBtsKembali.value = formattedDate;
            });
        }

        function closeModalAdd() {
            const modal = document.getElementById("modal-addData");
            modal.classList.add("hidden");
        }
    </script>

    {{-- SCRIPT MODAL UPDATE --}}
    <script>
        function updateData(id, kd_anggota, tg_pinjam, tgl_bts_kembali, kd_koleksi, routeUrl) {
            const modal = document.getElementById("modal-updateData");
            modal.classList.remove("hidden");

            const modalContent = document.getElementById("modal-content-update");
            modalContent.innerHTML = `

            <div class="lg:mb-5 mb-2 w-full">
                <label for="kd_anggota" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Anggota <span class="text-red-500">*</span></label>
                <select id="kd_anggota" class="form-control lg:w-[387px] w-[280px]" name="kd_anggota"data-placeholder="Pilih Anggota">
                    @foreach ($anggota as $a)
                        <option value="{{ $a->kd_anggota }}" ${kd_anggota === "{{ $a->kd_anggota }}" ? 'selected' : ''}>{{ $a->nm_anggota }}</option>
                    @endforeach
                </select>
            </div>
            <div class="lg:mb-5 mb-2 w-full">
                <label for="tgl_pinjam" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pinjam</label>
                <input type="date" id="tgl_pinjam" name="tgl_pinjam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500dark:focus:border-blue-500" value="${tg_pinjam}" />
            </div>
            <div class="lg:mb-5 mb-2 w-full">
                <label for="tgl_bts_kembali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Batas Kembali</label>
                <input type="date" id="tgl_bts_kembali" name="tgl_bts_kembali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lgfocus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-whitedark:focus:ring-blue-500 dark:focus:border-blue-500" value="${tgl_bts_kembali}"/>
            </div>
            <div class="lg:mb-5 mb-2 w-full">
                <label for="kd_koleksi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Koleksi <span class="text-red-500">*</span></label>
                <select id="kd_koleksi" class="form-control lg:w-[387px] w-[280px]" name="kd_koleksi"data-placeholder="Pilih Koleksi">
                    <option value="">Pilih...</option>
                    @foreach ($koleksi as $k)
                        <option value="{{ $k->kd_koleksi }}" ${kd_koleksi === "{{ $k->kd_koleksi }}" ? 'selected' : ''}>{{ $k->judul }}</option>
                    @endforeach
                </select>
            </div>
        `;
            const updateForm = document.getElementById("updateForm");
            updateForm.action = routeUrl;

            const maxBatasPinjam = @json($max_wkt_pjm);
            const inputTglPinjam = document.getElementById('tgl_pinjam');
            const inputTglBtsKembali = document.getElementById('tgl_bts_kembali');

            inputTglPinjam.addEventListener('change', function() {
                const tglPinjam = new Date(this.value);
                if (isNaN(tglPinjam)) return;

                tglPinjam.setDate(tglPinjam.getDate() + maxBatasPinjam);

                const yyyy = tglPinjam.getFullYear();
                const mm = String(tglPinjam.getMonth() + 1).padStart(2, '0');
                const dd = String(tglPinjam.getDate()).padStart(2, '0');
                const formattedDate = `${yyyy}-${mm}-${dd}`;

                inputTglBtsKembali.value = formattedDate;
            });
        }

        function closeModalUpdate(event) {
            event.preventDefault();
            document.getElementById("modal-updateData").classList.add("hidden");
        }
    </script>

    {{-- SCRIPT MODAL DELETE --}}
    <script>
        function deleteData(id, nama, routeUrl) {
            const modal = document.getElementById("modal-deleteData");
            modal.classList.remove("hidden");

            const message = document.getElementById("delete-message");
            message.textContent = `Apakah kamu yakin ingin menghapus trsPinjam dengan id "${id}"?`;

            const deleteForm = document.getElementById("deleteForm");
            deleteForm.action = routeUrl;
        }

        function closeModalDelete() {
            document.getElementById("modal-deleteData").classList.add("hidden");
        }
    </script>


</x-app-layout>
