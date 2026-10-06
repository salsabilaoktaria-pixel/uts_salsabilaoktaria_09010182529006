<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Perpustakaan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root { --sage:#5f8a7e; --sage-dark:#46705f; --sage-soft:#e5eee9; --border:#e2dbcf; --ink:#2f3a38; --muted:#7a847f; --sand:#faf8f4; }
        * { box-sizing: border-box; }
        body { font-family:'Inter',system-ui,sans-serif; color:var(--ink); min-height:100vh; display:flex; align-items:center; justify-content:center; padding:32px 16px;
            background: radial-gradient(circle at 12% 18%, #e5eee9 0, transparent 42%), radial-gradient(circle at 88% 82%, #f3ebd9 0, transparent 40%), #f6f3ee; position:relative; overflow-x:hidden; }
        .deco { position:fixed; border-radius:50%; border:1px solid rgba(95,138,126,.25); pointer-events:none; }
        .deco.a { width:420px; height:420px; top:-140px; right:-120px; }
        .deco.b { width:300px; height:300px; bottom:-110px; left:-90px; }

        .login-card { width:100%; max-width:480px; background:#fff; border:1px solid var(--border); border-radius:24px; padding:48px 44px 40px; box-shadow:0 18px 50px rgba(80,70,50,.10); position:relative; z-index:1; }
        @media (max-width:520px){ .login-card { padding:36px 24px 30px; } }
        .logo { width:72px; height:72px; border-radius:50%; background:var(--sage-soft); border:1px solid #cfe0d8; color:var(--sage-dark); display:flex; align-items:center; justify-content:center; font-size:32px; margin:0 auto 22px; }
        h1 { font-family:'Playfair Display',serif; font-weight:700; font-size:32px; text-align:center; margin:0 0 8px; }
        .sub { text-align:center; color:var(--muted); margin:0 0 34px; }

        label.form-label { font-weight:500; margin-bottom:8px; }
        .input-group-text { background:var(--sand); border:1px solid var(--border); color:var(--muted); border-radius:14px 0 0 14px; padding:0 18px; font-size:18px; }
        .form-control { border:1px solid var(--border); padding:15px 16px; font-size:16px; border-radius:0 14px 14px 0; }
        .form-control:focus { border-color:var(--sage); box-shadow:0 0 0 .22rem rgba(95,138,126,.18); }
        .input-group.is-error .input-group-text, .input-group.is-error .form-control { border-color:#e3b4b1; }
        .input-group .toggle { border:1px solid var(--border); border-left:0; background:#fff; color:var(--muted); border-radius:0 14px 14px 0; padding:0 18px; }
        .input-group .toggle:hover { color:var(--sage-dark); }
        .input-group .form-control.with-toggle { border-radius:0; }
        .form-check-input { width:1.15em; height:1.15em; border-color:#cfc6b6; }
        .form-check-input:checked { background-color:var(--sage); border-color:var(--sage); }
        .btn-login { background:var(--sage); border:1px solid var(--sage); color:#fff; border-radius:14px; padding:15px; font-size:17px; font-weight:600; }
        .btn-login:hover { background:var(--sage-dark); border-color:var(--sage-dark); color:#fff; }
        .alert-err { background:#f8e6e4; border:1px solid #efcdca; color:#a24a47; border-radius:14px; padding:14px 18px; margin-bottom:22px; display:flex; gap:10px; align-items:center; }
        .demo { margin-top:30px; background:var(--sand); border:1px dashed #d8cfbf; border-radius:16px; padding:18px 22px; font-size:14.5px; color:#5d6b66; }
        .demo .t { font-weight:600; color:var(--ink); margin-bottom:6px; }
        .demo code { background:#fff; border:1px solid var(--border); border-radius:8px; padding:2px 8px; color:var(--sage-dark); font-size:13.5px; }
        .foot { text-align:center; color:var(--muted); font-size:13px; margin-top:26px; }
    </style>
</head>
<body>
    <span class="deco a"></span>
    <span class="deco b"></span>

    <div class="login-card">
        <div class="logo"><i class="bi bi-book-half"></i></div>
        <h1>Perpustakaan</h1>
        <p class="sub">Masuk untuk mengelola data buku</p>

        @if ($errors->any())
            <div class="alert-err" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}" novalidate>
            @csrf

            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <div class="input-group {{ $errors->has('email') ? 'is-error' : '' }}">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           class="form-control" placeholder="nama@email.com" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" id="password" name="password"
                           class="form-control with-toggle" placeholder="Masukkan password" required>
                    <button type="button" class="toggle" id="togglePassword" aria-label="Tampilkan password">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-login w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
        </form>

        <div class="demo">
            <div class="t"><i class="bi bi-info-circle me-1"></i> Akun demo</div>
            Email <code>admin@perpustakaan.test</code><br>
            <span class="d-inline-block mt-2">Password <code>password</code></span>
        </div>

        <div class="foot">UTS Pemrograman Web III</div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            icon.className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    </script>
</body>
</html>
