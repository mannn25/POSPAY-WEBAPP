<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title') - Pospay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="dashboard-page">
    <aside class="sidebar d-flex flex-column p-3">
        <div class="d-flex align-items-center gap-3 px-2 mb-4">
            <div class="p-1 text-white d-flex align-items-center justify-content-center"
                style="width: 60px; height: 60px;">
                <img src="{{ asset('assets/pos.png') }}" alt="Logo" class="img-fluid" style="object-fit: contain;">
            </div>

            <div>
                <h6 class="mb-0 fw-bold">Pospay</h6>
                <small class="text-muted">Admin Terminal</small>
            </div>
        </div>
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('transaksi') ? 'active' : '' }}" href="{{ url('transaksi') }}">
                    <span class="material-symbols-outlined">list_alt</span>
                    <span>Transactions</span>
                </a>
            </li>
            @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('petugas') ? 'active' : '' }}" href="{{ url('petugas') }}">
                        <span class="material-symbols-outlined">group</span>
                        <span>Staff Member</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('service') ? 'active' : '' }}" href="{{ url('service') }}">
                        <span class="material-symbols-outlined">analytics</span>
                        <span>Services</span>
                    </a>
                </li>
            @endif
            <li class="mt-4 mb-2">
                <small class="text-uppercase text-muted fw-bold"
                    style="font-size: 0.65rem; padding-left: 1rem;">Support</small>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('logout') }}">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
        <div class="mt-auto pt-3 border-top">
            <div class="d-flex align-items-center gap-3 p-2 rounded bg-light">
                <div class="avatar"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCALvlNvfUgfAw3QqL7xNAz-WUeUGr1NHVMn88j8hmorhJKcmS52ziQ2bXSSkeeAlCNV9WDa7TdwBM_TPfxjWrMF9rfZQ_POdPeoKg7h26AKO6eJzNkXuR6hT0on1svmIA3XuSaCsxCYDXwdNNu7zHHwBbPloH3G1BDyQ3rMAw7fiM1-CWmOqiL36KkG9HuN20G5nsKPPgejTMca8drVY8zYSj-IPZNu9tBFO1JCYiZIKmX0myDZ-DCwTFRnv4PeVY_-ba1rT8Xby8'); background-size: cover; background-position: center;">
                </div>
                <div class="overflow-hidden">
                    <div class="fw-bold text-truncate" style="font-size: 0.85rem;">{{ Auth::user()->name }}</div>
                    <div class="text-muted text-truncate" style="font-size: 0.75rem;">{{ Auth::user()->role }}</div>
                </div>
            </div>
        </div>
    </aside>
    <main class="main-content p-4 p-lg-5">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    @stack('scripts')
</body>

</body>

</html>
