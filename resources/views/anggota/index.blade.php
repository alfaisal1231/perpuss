<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-4 py-4 flex justify-between items-center">
                    <div>Data Anggota</div>
                    <button onclick="return addData()">Tambah Anggota</button>
                </div>
                <div class="px-6 text-gray-900 dark:text-gray-100">
                    <table id="myDataTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Jumlah Pinjam</th>
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
                                    <td>{{ $d->kd_anggota }}</td>
                                    <td>{{ $d->nm_anggota }}</td>
                                    <td>{{ $d->jk }}</td>
                                    <td>{{ $d->alamat }}</td>
                                    <td>{{ $d->status }}</td>
                                    <td>{{ $d->jml_pinjam }}</td>
                                    <td>
                                        <button
                                            onclick="return updateData('{{ $d->id }}','{{ $d->nm_anggota }}','{{ $d->jk }}','{{ $d->alamat }}','{{ $d->status }}','{{ route('anggota.update', $d->id) }}')">Edit</button>
                                        <button
                                            onclick="return deleteData('{{ $d->id }}','{{ $d->nm_anggota }}', '{{ route('anggota.destroy', $d->id) }}')">Hapus</button>
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
            <h2 class="text-lg font-bold mb-4 bg-amber-100 p-2 rounded-xl">Add Anggota</h2>
            <form id="addForm" action="{{ route('anggota.store') }}" method="post" class="w-full">
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
            <h2 class="text-lg font-bold mb-4 bg-amber-100 p-2 rounded-xl">Update Anggota</h2>
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


    {{-- KODE DATA --}}
    <script>
        const kodeAnggotaBaru = @json($codeData);
    </script>

    {{-- SCRIPT MODAL ADD --}}
    <script>
        function addData() {
            const modalContent = document.getElementById("modal-content");
            modalContent.innerHTML = `
                <div class="lg:mb-5 mb-2 w-full">
                    <label for="kd_anggota" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Anggota</label>
                    <input type="text" id="kd_anggota" name="kd_anggota" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="${kodeAnggotaBaru}" />
                </div>
                <div class="lg:mb-5 mb-2 w-full">
                    <label for="nm_anggota" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Anggota</label>
                    <input type="text" id="nm_anggota" name="nm_anggota" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" />
                </div>
                <div class="lg:mb-5 mb-2 w-full">
                    <label for="jk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select id="jk" class="form-control lg:w-[387px] w-[280px]" name="jk"data-placeholder="Pilih Jenis Kelamin">
                        <option value="">Pilih...</option>
                        <option value="L">LAKI-LAKI</option>
                        <option value="P">PEREMPUAN</option>
                    </select>
                </div>
                <div class="lg:mb-5 mb-2 w-full">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <textarea type="text" id="alamat" name="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value=""></textarea>
                </div>
                <div class="lg:mb-5 mb-2 w-full">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status <span class="text-red-500">*</span></label>
                    <select id="status" class="form-control lg:w-[387px] w-[280px]" name="status"data-placeholder="Pilih Status">
                        <option value="">Pilih...</option>
                        <option value="AKTIF">AKTIF</option>
                        <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                    </select>
                </div>
            `;
            const modal = document.getElementById("modal-addData");
            modal.classList.remove("hidden");
        }

        function closeModalAdd() {
            const modal = document.getElementById("modal-addData");
            modal.classList.add("hidden");
        }
    </script>

    {{-- SCRIPT MODAL UPDATE --}}
    <script>
        function updateData(id, nama, jk, alamat, status, routeUrl) {
            const modal = document.getElementById("modal-updateData");
            modal.classList.remove("hidden");

            const modalContent = document.getElementById("modal-content-update");
            modalContent.innerHTML = `
            <div class="mb-4 w-full">
                <label for="nm_anggota" class="block mb-2 text-sm font-medium text-gray-900">Nama Anggota</label>
                <input type="text" id="nm_anggota" name="nm_anggota" value="${nama}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
            </div>
            <div class="mb-4 w-full">
                <label for="jk" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                <select id="jk" name="jk" class="form-control w-full">
                    <option value="">Pilih...</option>
                    <option value="L" ${jk === 'L' ? 'selected' : ''}>LAKI-LAKI</option>
                    <option value="P" ${jk === 'P' ? 'selected' : ''}>PEREMPUAN</option>
                </select>
            </div>
            <div class="mb-4 w-full">
                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                <textarea id="alamat" name="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">${alamat}</textarea>
            </div>
            <div class="mb-4 w-full">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
                <select id="status" name="status" class="form-control w-full">
                    <option value="">Pilih...</option>
                    <option value="AKTIF" ${status === 'AKTIF' ? 'selected' : ''}>AKTIF</option>
                    <option value="TIDAK AKTIF" ${status === 'TIDAK AKTIF' ? 'selected' : ''}>TIDAK AKTIF</option>
                </select>
            </div>
        `;
            const updateForm = document.getElementById("updateForm");
            updateForm.action = routeUrl;
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
            message.textContent = `Apakah kamu yakin ingin menghapus anggota dengan nama "${nama}"?`;

            const deleteForm = document.getElementById("deleteForm");
            deleteForm.action = routeUrl;
        }

        function closeModalDelete() {
            document.getElementById("modal-deleteData").classList.add("hidden");
        }
    </script>


</x-app-layout>
