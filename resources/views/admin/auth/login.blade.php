<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin - Tupan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
        }

        .login-box {
            max-width: 420px;
            width: 100%;
        }

        .login-card-body {
            border-radius: 16px;
            border: none;
        }

        .login-logo a {
            color: #d97706;
        }

        .btn-primary {
            background-color: #d97706;
            border-color: #b45309;
        }

        .btn-primary:hover:not(:disabled) {
            background-color: #b45309;
            border-color: #92400e;
        }

        .btn-primary:disabled {
            background-color: #9ca3af;
            border-color: #6b7280;
            cursor: not-allowed;
        }

        .alert-ban {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 8px;
        }
    </style>
</head>

<body class="hold-transition login-page"
    style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);">

    <div class="login-box">
        <div class="login-logo mb-4">
            <a href="{{ route('home') }}">
                <i class="fas fa-graduation-cap mr-2"></i><b>Tupan</b> Admin
            </a>
        </div>

        <div class="card login-card-body shadow-lg">
            <p class="login-box-msg text-dark-600 mb-4">Masuk ke Panel Admin</p>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show py-2 mb-3">
                    <small>{{ session('error') }}</small>
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <!-- Peringatan Banned / Menunggu Waktu -->
            @if ($banned)
                <div class="alert-ban p-3 mb-4 text-center" id="ban-alert">
                    <i class="fas fa-lock fa-2x mb-2 text-red-600"></i>
                    <h5 class="font-weight-bold mb-1">Akun Terkunci Sementara</h5>
                    <p class="mb-2" style="font-size: 13px;">Terlalu banyak percobaan login gagal. Silakan tunggu:</p>
                    <div class="font-weight-bold text-2xl text-red-600" id="countdown-timer">{{ $wait_time }} detik
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" id="login-form">
                @csrf

                <div class="input-group mb-3">
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                        @if ($banned) disabled @endif>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block" style="font-size:13px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" required
                        class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                        @if ($banned) disabled @endif>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block" style="font-size:13px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}
                                @if ($banned) disabled @endif>
                            <label for="remember">Ingat Saya</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" id="login-btn"
                            @if ($banned) disabled @endif>
                            <i class="fas fa-sign-in-alt mr-1"></i> Masuk
                        </button>
                    </div>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('home') }}" class="text-muted text-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Website
                </a>
            </div>
        </div>

        <p class="text-center text-gray-500 mt-3" style="font-size:11px;">
            &copy; {{ date('Y') }} Sekolah Unggulan Indonesia
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    @if ($banned)
        <script>
            // Logika Countdown Timer 2 Menit
            let timeLeft = {{ $wait_time }};
            const timerElement = document.getElementById('countdown-timer');
            const loginForm = document.getElementById('login-form');
            const loginBtn = document.getElementById('login-btn');
            const banAlert = document.getElementById('ban-alert');

            // Fungsi format waktu ke Menit:Detik
            function formatTime(seconds) {
                const m = Math.floor(seconds / 60);
                const s = seconds % 60;
                return m.toString().padStart(2, '0') + ':' + s.toString().padStart(2, '0');
            }

            const countdownInterval = setInterval(function() {
                timeLeft--;

                // Update tampilan timer
                timerElement.innerText = formatTime(timeLeft);

                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);

                    // Hapus alert peringatan
                    banAlert.remove();

                    // Aktifkan kembali form dan tombol
                    loginBtn.disabled = false;
                    loginBtn.innerHTML = '<i class="fas fa-sign-in-alt mr-1"></i> Masuk';

                    document.querySelectorAll('#login-form input').forEach(function(input) {
                        input.disabled = false;
                    });

                    // Auto-focus ke input email
                    document.querySelector('input[name="email"]').focus();
                }
            }, 1000);

            // Set format awal saat pertama kali load
            timerElement.innerText = formatTime(timeLeft);
        </script>
    @endif

</body>

</html>
