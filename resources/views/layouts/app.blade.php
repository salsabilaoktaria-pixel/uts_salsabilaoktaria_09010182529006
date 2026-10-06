<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Perpustakaan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --bg: #f6f3ee;
            --surface: #ffffff;
            --border: #e2dbcf;
            --ink: #2f3a38;
            --muted: #7a847f;
            --sage: #5f8a7e;
            --sage-dark: #46705f;
            --sage-soft: #e5eee9;
            --gold: #c4a062;
            --sand: #faf8f4;
            --sidebar-w: 280px;
        }
        html { font-size: 16px; }
        body { font-family: 'Inter', system-ui, sans-serif; background: var(--bg); color: var(--ink); font-size: 1rem; }
        h1, h2, h3, .serif { font-family: 'Playfair Display', Georgia, serif; }

        /* ===== Sidebar ===== */
        .sidebar { width: var(--sidebar-w); position: fixed; inset: 0 auto 0 0; z-index: 1030; }
        .sidebar-inner { height: 100%; display: flex; flex-direction: column; padding: 28px 20px; background: var(--sand); border-right: 1px solid var(--border); }
        .brand { display: flex; align-items: center; gap: 14px; text-decoration: none; color: var(--ink); padding: 0 8px 24px; border-bottom: 1px solid var(--border); }
        .brand .logo { width: 48px; height: 48px; border-radius: 14px; background: var(--sage); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 24px; }
        .brand .name { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 20px; line-height: 1.1; }
        .brand small { display: block; font-family: 'Inter', sans-serif; font-weight: 400; font-size: 12px; color: var(--muted); margin-top: 4px; }
        .menu-label { font-size: 12px; text-transform: uppercase; letter-spacing: .1em; color: var(--muted); margin: 26px 12px 10px; }
        .sidebar .nav-link { color: var(--ink); border-radius: 12px; padding: 13px 16px; display: flex; align-items: center; gap: 14px; font-weight: 500; margin-bottom: 6px; border: 1px solid transparent; }
        .sidebar .nav-link i { font-size: 19px; color: var(--muted); }
        .sidebar .nav-link:hover { background: var(--sage-soft); }
        .sidebar .nav-link.active { background: var(--sage-soft); border-color: #cfe0d8; color: var(--sage-dark); font-weight: 600; }
        .sidebar .nav-link.active i { color: var(--sage-dark); }
        .user-box { margin-top: auto; background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 18px; }
        .avatar { width: 44px; height: 44px; border-radius: 50%; background: var(--sage-soft); color: var(--sage-dark); border: 1px solid #cfe0d8; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 18px; flex-shrink: 0; }
        .user-box .uname { font-weight: 600; font-size: 15px; line-height: 1.25; }
        .user-box .umail { font-size: 12px; color: var(--muted); word-break: break-all; }
        .sidebar-offcanvas { width: var(--sidebar-w) !important; border: 0; }

        /* ===== Konten ===== */
        .content { min-height: 100vh; }
        @media (min-width: 992px) { .content { margin-left: var(--sidebar-w); } }
        .topbar { background: rgba(255,255,255,.9); backdrop-filter: blur(6px); border-bottom: 1px solid var(--border); padding: 16px 32px; display: flex; align-items: center; gap: 14px; position: sticky; top: 0; z-index: 1020; }
        .topbar .page-title { font-family: 'Playfair Display', serif; font-weight: 600; font-size: 20px; margin: 0; }
        .topbar .date { margin-left: auto; font-size: 14px; color: var(--muted); }
        .page { padding: 36px 32px 56px; max-width: 1320px; }
        @media (max-width: 575px) { .page { padding: 24px 16px 40px; } .topbar { padding: 14px 16px; } }
        .page-header { display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 28px; }
        .page-header h1 { font-size: 30px; font-weight: 700; margin: 0; }
        .page-header p { margin: 6px 0 0; color: var(--muted); }

        /* ===== Komponen ===== */
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 18px; box-shadow: 0 2px 10px rgba(80, 70, 50, .05); }
        .card-header { background: var(--sand); border-bottom: 1px solid var(--border); border-radius: 18px 18px 0 0 !important; padding: 20px 28px; font-weight: 600; font-size: 17px; }
        .card-body { padding: 28px; }
        .card-footer { background: var(--sand); border-top: 1px solid var(--border); border-radius: 0 0 18px 18px !important; padding: 16px 28px; }

        .btn { border-radius: 12px; font-weight: 500; padding: .65rem 1.25rem; font-size: 1rem; display: inline-flex; align-items: center; justify-content: center; gap: .5rem; }
        .btn-lg { padding: .85rem 1.5rem; font-size: 1.05rem; }
        .btn-sm { padding: .5rem 1rem; font-size: .92rem; }
        .btn-primary { --bs-btn-bg: var(--sage); --bs-btn-border-color: var(--sage); --bs-btn-hover-bg: var(--sage-dark); --bs-btn-hover-border-color: var(--sage-dark); --bs-btn-active-bg: var(--sage-dark); --bs-btn-active-border-color: var(--sage-dark); --bs-btn-disabled-bg: var(--sage); --bs-btn-disabled-border-color: var(--sage); }
        .btn-outline-neutral { background: #fff; border: 1px solid var(--border); color: var(--ink); }
        .btn-outline-neutral:hover { background: var(--sand); border-color: #cfc6b6; color: var(--ink); }
        .btn-soft-sage { background: var(--sage-soft); border: 1px solid #cfe0d8; color: var(--sage-dark); }
        .btn-soft-sage:hover { background: #d8e7e0; color: var(--sage-dark); }
        .btn-soft-gold { background: #f8efd9; border: 1px solid #ecdcae; color: #84621f; }
        .btn-soft-gold:hover { background: #f3e5c1; color: #84621f; }
        .btn-soft-rose { background: #f8e6e4; border: 1px solid #efcdca; color: #a24a47; }
        .btn-soft-rose:hover { background: #f3d7d4; color: #a24a47; }

        .form-label { font-weight: 500; margin-bottom: .5rem; }
        .form-control, .form-select { border: 1px solid var(--border); border-radius: 12px; padding: .8rem 1rem; font-size: 1rem; background-color: #fff; color: var(--ink); }
        .form-control:focus, .form-select:focus { border-color: var(--sage); box-shadow: 0 0 0 .22rem rgba(95,138,126,.18); }
        .input-group-text { background: var(--sand); border: 1px solid var(--border); color: var(--muted); border-radius: 12px 0 0 12px; padding: 0 1rem; font-size: 1.05rem; }
        .input-group > .form-control, .input-group > .form-select { border-radius: 0 12px 12px 0; }
        .input-group.has-validation > .form-control, .input-group.has-validation > .form-select { border-radius: 0 12px 12px 0; }
        .form-check-input:checked { background-color: var(--sage); border-color: var(--sage); }

        .welcome { background: linear-gradient(120deg, #e5eee9, #f3ebd9); border: 1px solid var(--border); border-radius: 18px; padding: 34px 36px; position: relative; overflow: hidden; }
        .welcome::after { content: "\F5E5"; font-family: 'bootstrap-icons'; position: absolute; right: 30px; bottom: -28px; font-size: 150px; color: var(--sage); opacity: .12; }
        .welcome h2 { font-size: 28px; margin: 0 0 8px; }
        .welcome p { margin: 0; color: #5d6b66; font-size: 1.05rem; }

        .stat-card .card-body { display: flex; align-items: center; gap: 20px; padding: 28px; }
        .stat-card .icon { width: 62px; height: 62px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 28px; flex-shrink: 0; }
        .stat-card .num { font-size: 34px; font-weight: 600; line-height: 1.1; font-family: 'Playfair Display', serif; }
        .stat-card .lbl { color: var(--muted); font-size: 14px; margin-top: 2px; }
        .ic-sage { background: var(--sage-soft); color: var(--sage-dark); }
        .ic-gold { background: #f8efd9; color: #84621f; }
        .ic-sky { background: #e4eef3; color: #3f6d85; }
        .ic-rose { background: #f8e6e4; color: #a24a47; }

        .table { --bs-table-bg: transparent; --bs-table-hover-bg: #f7f4ee; margin-bottom: 0; font-size: 1rem; }
        .table thead th { background: var(--sand); color: #6a746f; font-size: 13px; text-transform: uppercase; letter-spacing: .06em; font-weight: 600; border-bottom: 1px solid var(--border); padding: 18px 20px; white-space: nowrap; }
        .table tbody td { padding: 20px; vertical-align: middle; border-color: #eee8dd; }
        .table-wrap { border-top: 0; }
        .book-title { font-weight: 600; color: var(--ink); text-decoration: none; }
        .book-title:hover { color: var(--sage-dark); text-decoration: underline; }
        .pill { display: inline-block; padding: .45rem .95rem; border-radius: 999px; font-size: 13.5px; font-weight: 500; line-height: 1.2; white-space: nowrap; }
        .pill.cat { background: var(--sage-soft); color: var(--sage-dark); border: 1px solid #cfe0d8; }
        .pill.stock-ok { background: #e5f1e9; color: #2f6b4b; border: 1px solid #c8e0d0; }
        .pill.stock-low { background: #f8efd9; color: #84621f; border: 1px solid #ecdcae; }
        .pill.stock-out { background: #f8e6e4; color: #a24a47; border: 1px solid #efcdca; }
        .row-actions { display: inline-flex; gap: 8px; }
        .empty-state { text-align: center; padding: 64px 24px; color: var(--muted); }
        .empty-state i { font-size: 56px; color: #cfc6b6; }

        .detail-label { font-size: 13px; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); margin-bottom: 6px; }
        .detail-value { font-size: 17px; font-weight: 500; margin-bottom: 26px; }
        .stock-big { font-family: 'Playfair Display', serif; font-size: 64px; font-weight: 700; line-height: 1; }
        .progress { height: 10px; border-radius: 999px; background: #eee8dd; }
        .progress-bar { background: var(--sage); border-radius: 999px; }
        .pagination { margin-bottom: 0; }
        .page-link { border-radius: 10px !important; margin: 0 3px; color: var(--sage-dark); border: 1px solid var(--border); padding: .55rem .95rem; }
        .page-item.active .page-link { background: var(--sage); border-color: var(--sage); color: #fff; }
        .list-group-item { padding: 18px 28px; border-color: #eee8dd; }
        .alert { border-radius: 14px; padding: 16px 20px; font-size: 1rem; }
        .alert-success { background: #e5f1e9; border: 1px solid #c8e0d0; color: #2f6b4b; }
        .alert-danger { background: #f8e6e4; border: 1px solid #efcdca; color: #a24a47; }
    </style>
</head>
<body>

    {{-- Sidebar desktop --}}
    <aside class="sidebar d-none d-lg-block">
        @include('layouts._sidebar')
    </aside>

    {{-- Sidebar mobile --}}
    <div class="offcanvas offcanvas-start sidebar-offcanvas" tabindex="-1" id="mobileMenu">
        @include('layouts._sidebar')
    </div>

    <div class="content">
        <header class="topbar">
            <button class="btn btn-outline-neutral d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-label="Menu">
                <i class="bi bi-list fs-5"></i>
            </button>
            <h6 class="page-title">@yield('title', 'Dashboard')</h6>
            <span class="date d-none d-md-inline"><i class="bi bi-calendar3 me-2"></i>{{ now()->locale('id')->translatedFormat('l, d F Y') }}</span>
        </header>

        <main class="page">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- Modal konfirmasi hapus --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border:1px solid var(--border); border-radius:20px;">
                <div class="modal-body text-center p-5">
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center rounded-circle" style="width:76px;height:76px;background:#f8e6e4;color:#a24a47;">
                        <i class="bi bi-trash3 fs-2"></i>
                    </div>
                    <h4 class="serif mb-2">Hapus buku ini?</h4>
                    <p class="text-secondary mb-4"><strong id="deleteName"></strong><br>akan dihapus permanen dan tidak bisa dikembalikan.</p>
                    <form method="POST" id="deleteForm" class="d-flex gap-3 justify-content-center">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-neutral px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-soft-rose px-4"><i class="bi bi-trash3"></i> Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('[data-delete-url]');
            if (!btn) return;
            document.getElementById('deleteForm').action = btn.dataset.deleteUrl;
            document.getElementById('deleteName').textContent = btn.dataset.deleteName;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        });
    </script>
</body>
</html>
