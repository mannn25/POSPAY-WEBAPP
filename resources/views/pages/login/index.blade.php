<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Pospay - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/apple-touch-icon.png') }}">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="login-page">
    <div class="container d-flex flex-column align-items-center py-5">
        <div class="text-center mb-4">
            <div class="logo-container">
                <div class="p-1 text-white d-flex align-items-center justify-content-center">
                    <img src="{{ asset('assets/pos.png') }}" alt="Logo" class="img-fluid"
                        style="object-fit: contain;">
                </div>
            </div>
            <h1 class="h4 fw-bold text-dark mb-1">Pospay Admin Terminal</h1>
            <p class="text-secondary small">Manage your financial network services</p>
        </div>

        <div class="card login-card p-4 p-md-5">
            <div class="mb-4">
                <h2 class="h5 fw-bold mb-1">Login</h2>
                <p class="text-muted small">Enter your credentials to access the dashboard</p>
            </div>

            <form action="{{ url('login-proses') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-medium" for="username">Username</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <span class="material-symbols-outlined">person</span>
                        </span>
                        <input class="form-control" id="username" name="username" placeholder="Enter your username"
                            required type="text" />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-medium" for="password">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <span class="material-symbols-outlined">lock</span>
                        </span>
                        <input class="form-control border-end-0" id="password" name="password" placeholder="••••••••"
                            required type="password" />
                        <button class="btn btn-password-toggle" id="togglePassword" type="button">
                            <span class="material-symbols-outlined" id="eyeIcon">visibility</span>
                        </button>
                    </div>
                </div>

                <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2"
                    type="submit">
                    Sign In
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </form>
        </div>

        <div class="footer-text mt-5 text-center">
            ©
            <script>
                document.write(new Date().getFullYear())
            </script> Pospay Admin Terminal. All rights reserved.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function() {
            // Toggle tipe input
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle ikon mata
            eyeIcon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
        });
    </script>
</body>

</html>
