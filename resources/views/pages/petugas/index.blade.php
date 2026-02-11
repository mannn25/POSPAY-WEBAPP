@extends('layout.template')
@section('title', 'Data Petugas')

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-5">
        <div>
            <h2 class="fw-black mb-1">Staff Member Management</h2>
            <p class="text-muted mb-0">Monitor and process financial data across the entire Pospay network.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2" id="btnShowForm">
                <span class="material-symbols-outlined">add</span>
                <span class="fw-bold small">New Staff Member</span>
            </button>
        </div>
    </div>

    <div id="formUser" style="display: none;" class="card mb-4">
        <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="card-title mb-0 fw-bold d-flex align-items-center gap-2">
                <span class="material-symbols-outlined text-primary">person_add</span>
                Add New Staff Member
            </h5>
        </div>
        <div class="card-body p-4">
            <form id="staffForm" action="{{ url('petugas/insert') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="username">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <span class="material-symbols-outlined">alternate_email</span>
                                </span>
                                <input class="form-control border-start-0" id="username" name="username"
                                    placeholder="e.g. jaka_admin" type="text" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="password">Security Password</label>
                            <div class="input-group">
                                <input class="form-control" id="password" name="password" placeholder="••••••••"
                                    required="" type="password" />
                                <button class="btn btn-outline-secondary" onclick="togglePasswordVisibility()"
                                    type="button">
                                    <span class="material-symbols-outlined" id="passIcon">visibility</span>
                                </button>
                            </div>
                            <div class="form-text mt-2 small text-muted italic">
                                <em>Ensure at least 8 characters with numbers.</em>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="name">Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <span class="material-symbols-outlined">badge</span>
                                </span>
                                <input class="form-control border-start-0" id="name" name="name"
                                    placeholder="e.g. Jaka Pratama" required="" type="text" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="role">Staff Role / Position</label>
                            <select class="form-select" id="role" name="role" required="">
                                <option disabled="" selected="" value="">Select a role...</option>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr class="my-4 opacity-50" />
                <div class="d-flex flex-column flex-sm-row gap-2">
                    <button class="btn btn-primary px-4 d-flex align-items-center justify-content-center gap-2"
                        type="submit">
                        <span class="material-symbols-outlined">save</span>
                        Save Staff Member
                    </button>
                    <button class="btn btn-outline-secondary px-4 d-flex align-items-center justify-content-center gap-2"
                        type="button" id="btnHideForm">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Back to List
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="formEditPetugas" style="display: none;" class="card mb-4">
        <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="card-title mb-0 fw-bold d-flex align-items-center gap-2">
                <span class="material-symbols-outlined text-warning">edit_square</span>
                Edit Staff Member
            </h5>
        </div>
        <div class="card-body p-4">
            <form id="editStaffForm" method="POST">
                @csrf
                @method('PUT') <input type="hidden" name="id" id="petugasIdEdit">

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="usernameEdit">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <span class="material-symbols-outlined">alternate_email</span>
                                </span>
                                <input class="form-control border-start-0" id="usernameEdit" name="username"
                                    type="text" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="passwordEdit">New Password (Empty if no
                                change)</label>
                            <div class="input-group">
                                <input class="form-control" id="passwordEdit" name="password" placeholder="••••••••"
                                    type="password" />
                                <button class="btn btn-outline-secondary" onclick="togglePasswordVisibilityEdit()"
                                    type="button">
                                    <span class="material-symbols-outlined" id="passIconEdit">visibility</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="nameEdit">Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <span class="material-symbols-outlined">badge</span>
                                </span>
                                <input class="form-control border-start-0" id="nameEdit" name="name" required=""
                                    type="text" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium" for="roleEdit">Staff Role / Position</label>
                            <select class="form-select" id="roleEdit" name="role" required="">
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr class="my-4 opacity-50" />
                <div class="d-flex flex-column flex-sm-row gap-2">
                    <button class="btn btn-warning px-4 d-flex align-items-center justify-content-center gap-2"
                        type="submit">
                        <span class="material-symbols-outlined">update</span>
                        Update Staff Member
                    </button>
                    <button class="btn btn-outline-secondary px-4 d-flex align-items-center justify-content-center gap-2"
                        type="button" onclick="document.getElementById('formEditPetugas').style.display='none'">
                        <span class="material-symbols-outlined">close</span>
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <span class="material-symbols-outlined text-muted">search</span>
                        </span>
                        <input class="form-control border-start-0" id="filterSearch" placeholder="Search petugas..."
                            type="text">
                    </div>
                </div>
                <div class="col-md-5">
                    <select class="form-select" id="filterRole">
                        <option value="">All Roles</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-center justify-content-end">
                    <button id="btnClearFilter"
                        class="btn btn-link text-decoration-none text-primary fw-semibold p-0 small">Clear</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive p-3">
            <table id="tabelPetugas" class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;"><input class="form-check-input" type="checkbox" />
                        </th>
                        <th>Nama</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Role</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($petugas as $item)
                        <tr>
                            <td class="text-center"><input class="form-check-input" type="checkbox" /></td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 35px; height: 35px; font-size: 0.8rem; font-weight: 700; 
                                                background-color: {{ $item->avatar_bg }}; 
                                                color: {{ $item->avatar_text }};">
                                        {{ strtoupper(substr($item->name, 0, 2)) }}
                                    </div>
                                    <div class="fw-bold">{{ $item->name }}</div>
                                </div>
                            </td>
                            <td class="text-center">{{ $item->username }}</td>
                            <td class="text-center">{{ $item->role }}</td>
                            <td class="text-end">
                                <button class="btn btn-link text-primary mb-0 btnEdit" data-id="{{ $item->id }}"
                                    data-username="{{ $item->username }}" data-nama="{{ $item->name }}"
                                    data-role="{{ $item->role }}">
                                    <span class="material-symbols-outlined">edit</span>
                                </button>
                                <button class="btn btn-link text-danger mb-0 btnDelete" data-id="{{ $item->id }}"
                                    data-nama="{{ $item->name }}">
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
                document.getElementById('formUser').style.display = 'block';
            });

            function togglePasswordVisibility() {
                const passwordInput = document.getElementById('password');
                const icon = document.getElementById('passIcon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.textContent = 'visibility_off';
                } else {
                    passwordInput.type = 'password';
                    icon.textContent = 'visibility';
                }
            }

            document.getElementById('btnHideForm').addEventListener('click', function() {
                document.getElementById('formUser').style.display = 'none';
            });

            document.querySelectorAll('.btnEdit').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    // Ambil data dari atribut tombol
                    const id = this.dataset.id;
                    const username = this.dataset.username;
                    const nama = this.dataset.nama;
                    const role = this.dataset.role;

                    // Isi form dengan data yang diambil
                    document.getElementById('petugasIdEdit').value = id;
                    document.getElementById('usernameEdit').value = username;
                    document.getElementById('nameEdit').value = nama;
                    document.getElementById('roleEdit').value = role;

                    // Set action form dinamis ke route update
                    const formEdit = document.getElementById('editStaffForm');
                    formEdit.action = '/petugas/update/' + id;

                    // Sembunyikan form Add (jika ada) dan tampilkan form Edit
                    if (document.getElementById('formUser')) {
                        document.getElementById('formUser').style.display = 'none';
                    }
                    document.getElementById('formEditPetugas').style.display = 'block';

                    // Scroll otomatis ke form edit agar user melihatnya
                    document.getElementById('formEditPetugas').scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Fungsi tambahan untuk toggle password di form edit
            function togglePasswordVisibilityEdit() {
                const passInput = document.getElementById('passwordEdit');
                const passIcon = document.getElementById('passIconEdit');
                if (passInput.type === 'password') {
                    passInput.type = 'text';
                    passIcon.innerText = 'visibility_off';
                } else {
                    passInput.type = 'password';
                    passIcon.innerText = 'visibility';
                }
            }

            document.querySelectorAll('.btnDelete').forEach(function(btn) {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;
                    const nama = this.dataset.nama; // opsional

                    Swal.fire({
                        title: "Hapus Data Petugas?",
                        html: `Data <b>${nama}</b> akan dihapus dan tidak bisa dikembalikan.`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect ke route delete
                            window.location.href = '/petugas/delete/' + id;
                        }
                    });

                });
            });

            $(document).ready(function() {
                // 1. Inisialisasi DataTable dan simpan ke variabel 'table'
                var table = $('#tabelPetugas').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "pagingType": "full_numbers",
                    "language": {
                        "search": "", // Kita sembunyikan search bawaan karena sudah pakai custom search bar
                        "paginate": {
                            "first": "«",
                            "last": "»",
                            "previous": "‹",
                            "next": "›"
                        }
                    },
                    // Hapus 'f' dari DOM karena kita pakai input search kustom kita sendiri
                    "dom": 'rt<"d-flex justify-content-between align-items-center mt-3"ip>'
                });

                // 2. Fungsi Filter Pencarian (Global Search)
                $('#filterSearch').on('keyup', function() {
                    table.search(this.value).draw();
                });

                // 3. Fungsi Filter Kolom (Spesifik Kolom Role - Indeks kolom ke-3)
                $('#filterRole').on('change', function() {
                    // .column(3) berarti kolom Role (0: Checkbox, 1: Nama, 2: Username, 3: Role)
                    table.column(3).search(this.value).draw();
                });

                // 4. Tombol Clear Filter
                $('#btnClearFilter').on('click', function() {
                    $('#filterSearch').val('');
                    $('#filterRole').val('');
                    table.search('').column(3).search('').draw();
                });
            });
        </script>
    @endpush
@endsection
