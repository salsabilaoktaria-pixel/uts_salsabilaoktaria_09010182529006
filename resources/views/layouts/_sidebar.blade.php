<div class="sidebar-inner">
    <a href="{{ route('dashboard') }}" class="brand">
        <span class="logo"><i class="bi bi-book-half"></i></span>
        <span class="name">Perpustakaan<small>Manajemen Data Buku</small></span>
    </a>

    <div class="menu-label">Menu</div>
    <nav class="nav flex-column">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a class="nav-link {{ request()->routeIs('books.index') || request()->routeIs('books.show') || request()->routeIs('books.edit') ? 'active' : '' }}" href="{{ route('books.index') }}">
            <i class="bi bi-journal-bookmark-fill"></i> Daftar Buku
        </a>
        <a class="nav-link {{ request()->routeIs('books.create') ? 'active' : '' }}" href="{{ route('books.create') }}">
            <i class="bi bi-journal-plus"></i> Tambah Buku
        </a>
    </nav>

    <div class="user-box">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="uname">{{ auth()->user()->name }}</div>
                <div class="umail">{{ auth()->user()->email }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-neutral w-100">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>
