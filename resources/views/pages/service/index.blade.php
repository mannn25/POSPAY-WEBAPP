@extends('layout.template')
@section('title', 'Data Layanan')

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-5">
        <div>
            <h2 class="fw-black mb-1">Service Management</h2>
            <p class="text-muted mb-0">Monitor and process financial data across the entire Pospay network.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2" id="btnShowForm">
                <span class="material-symbols-outlined">add</span>
                <span class="fw-bold small">New Service</span>
            </button>
        </div>
    </div>

    @if (session('success'))
        <div id="alertTime" class="alert alert-success text-white py-2 px-3 mb-3 small" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
        </div>
    @endif

    @if (session('delete'))
        <div id="alertTime" class="alert alert-danger text-white py-2 px-3 mb-3 small" role="alert">
            <strong>Berhasil!</strong> {{ session('delete') }}
        </div>
    @endif

    <div id="formService" style="display: none;" class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="card-title mb-0 fw-bold d-flex align-items-center gap-2">
                <span class="material-symbols-outlined text-primary">add_box</span>
                Tambah Layanan Baru
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ url('service/insert') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="kode_layanan">Kode Layanan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <span class="material-symbols-outlined">qr_code</span>
                                </span>
                                <input class="form-control border-start-0" id="kode_layanan" name="kode_layanan"
                                    placeholder="e.g. SRV-001" type="text" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="nama_layanan">Jenis Layanan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <span class="material-symbols-outlined">category</span>
                                </span>
                                <input class="form-control border-start-0" id="nama_layanan" name="nama_layanan"
                                    placeholder="e.g. Kilat Khusus" required type="text" />
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4 opacity-50" />

                <div class="d-flex flex-column flex-sm-row gap-2">
                    <button class="btn btn-primary px-4 d-flex align-items-center justify-content-center gap-2"
                        type="submit">
                        <span class="material-symbols-outlined">save</span>
                        Simpan Layanan
                    </button>
                    <button class="btn btn-outline-secondary px-4 d-flex align-items-center justify-content-center gap-2"
                        type="button" id="btnHideForm">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Kembali ke Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="formEditService" style="display: none;" class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="card-title mb-0 fw-bold d-flex align-items-center gap-2">
                <span class="material-symbols-outlined text-warning">edit_note</span>
                Edit Data Layanan
            </h5>
        </div>
        <div class="card-body p-4">
            <form id="formEditServiceForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="idEdit">

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="kode_layananEdit">Kode Layanan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <span class="material-symbols-outlined">qr_code</span>
                                </span>
                                <input class="form-control border-start-0" id="kode_layananEdit" name="kode_layanan"
                                    placeholder="Masukkan kode layanan..." type="text" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="nama_layananEdit">Jenis Layanan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <span class="material-symbols-outlined">category</span>
                                </span>
                                <input class="form-control border-start-0" id="nama_layananEdit" name="nama_layanan"
                                    placeholder="Masukkan nama layanan..." required type="text" />
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4 opacity-50"/>

                <div class="d-flex flex-column flex-sm-row gap-2">
                    <button class="btn btn-warning text-white px-4 d-flex align-items-center justify-content-center gap-2"
                        type="submit">
                        <span class="material-symbols-outlined">update</span>
                        Perbarui Layanan
                    </button>
                    <button class="btn btn-outline-secondary px-4 d-flex align-items-center justify-content-center gap-2"
                        type="button" id="btnHideFormEdit">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Batal Edit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive p-3">
            <table id="tabelService" class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="text-center">Kode Layanan</th>
                        <th class="text-center">Jenis Layanan</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($service as $item)
                        <tr>
                            <td class="text-center">{{ $item->kode_layanan }}</td>
                            <td class="text-center">{{ $item->nama_layanan }}</td>
                            <td class="text-end">
                                <button class="btn btn-link text-primary mb-0 btnEdit" data-id="{{ $item->id }}" data-kode="{{ $item->kode_layanan}}"
                                    data-nama="{{ $item->nama_layanan }}">
                                    <span class="material-symbols-outlined">edit</span>
                                </button>
                                <button class="btn btn-link text-danger mb-0 btnDelete" data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama_layanan }}">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('btnShowForm').addEventListener('click', function() {
                document.getElementById('formService').style.display = 'block';
            });

            document.getElementById('btnHideForm').addEventListener('click', function() {
                document.getElementById('formService').style.display = 'none';
            });

            document.getElementById('btnHideFormEdit').addEventListener('click', function() {
                document.getElementById('formEditService').style.display = 'none';
            });

            document.querySelectorAll('.btnEdit').forEach(function(btn) {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;
                    const kode = this.dataset.kode;
                    const nama = this.dataset.nama;

                    // Isi form
                    document.getElementById('idEdit').value = id;
                    document.getElementById('kode_layananEdit').value = kode;
                    document.getElementById('nama_layananEdit').value = nama;


                    // SET ACTION FORM DENGAN ID
                    const formEdit = document.getElementById('formEditServiceForm');
                    formEdit.action = '/service/update/' + id;

                    // Tampilkan form edit
                    document.getElementById('formEditService').style.display = 'block';
                });
            });


            document.querySelectorAll('.btnDelete').forEach(function(btn) {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;
                    const nama = this.dataset.nama; // opsional

                    Swal.fire({
                        title: "Hapus Jenis layanan?",
                        html: `Data <b>${nama}</b> akan dihapus dan tidak bisa dikembalikan.`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect ke route delete
                            window.location.href = '/service/delete/' + id;
                        }
                    });

                });
            });

            $(document).ready(function() {
                // Hancurkan instance lama jika ada untuk menghindari inisialisasi ganda
                if ($.fn.DataTable.isDataTable('#tabelService')) {
                    $('#tabelService').DataTable().destroy();
                }

                $('#tabelService').DataTable({
                    "paging": true, // Pastikan ini true
                    "searching": true, // Pastikan ini true
                    "ordering": true,
                    "info": true,
                    "pagingType": "full_numbers",
                    "language": {
                        "search": "",
                        "searchPlaceholder": "Cari service...",
                        "paginate": {
                            "first": "«",
                            "last": "»",
                            "previous": "‹",
                            "next": "›"
                        }
                    },
                    // Perhatikan bagian DOM ini
                    "dom": '<"d-flex justify-content-end mb-3"f>rt<"d-flex justify-content-between align-items-center mt-3"ip>'
                });
            });

            setTimeout(function() {
                const alert = document.getElementById('alertTime');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    alert.remove();
                }
            }, 3000);
        </script>
    @endpush
@endsection
