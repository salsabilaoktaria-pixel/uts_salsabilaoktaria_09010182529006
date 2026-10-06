@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="welcome mb-4">
        <h2>Halo, {{ auth()->user()->name }}</h2>
        <p>Berikut ringkasan data perpustakaan Anda.</p>
    </div>

    {{-- Kartu statistik --}}
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card h-100"><div class="card-body">
                <div class="icon ic-sage"><i class="bi bi-journal-bookmark-fill"></i></div>
                <div><div class="num">{{ $totalBooks }}</div><div class="lbl">Judul Buku</div></div>
            </div></div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card h-100"><div class="card-body">
                <div class="icon ic-gold"><i class="bi bi-tags-fill"></i></div>
                <div><div class="num">{{ $totalCategories }}</div><div class="lbl">Kategori</div></div>
            </div></div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card h-100"><div class="card-body">
                <div class="icon ic-sky"><i class="bi bi-stack"></i></div>
                <div><div class="num">{{ number_format($totalStock, 0, ',', '.') }}</div><div class="lbl">Total Stok</div></div>
            </div></div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card h-100"><div class="card-body">
                <div class="icon ic-rose"><i class="bi bi-exclamation-triangle-fill"></i></div>
                <div><div class="num">{{ $lowStockCount }}</div><div class="lbl">Stok Menipis</div></div>
            </div></div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Buku terbaru --}}
        <div class="col-xl-7">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between gap-3">
                    <span><i class="bi bi-clock-history me-2" style="color:var(--sage-dark)"></i>Buku Terbaru</span>
                    <a href="{{ route('books.index') }}" class="btn btn-soft-sage btn-sm">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr><th>Judul</th><th>Kategori</th><th class="text-center">Stok</th></tr>
                        </thead>
                        <tbody>
                            @forelse ($latestBooks as $book)
                                <tr>
                                    <td>
                                        <a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a>
                                        <div class="small text-secondary mt-1">{{ $book->author }}</div>
                                    </td>
                                    <td><span class="pill cat">{{ $book->category->name }}</span></td>
                                    <td class="text-center"><span class="{{ $book->stockBadgeClass() }}">{{ $book->stock }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="3"><div class="empty-state"><i class="bi bi-inbox"></i><div class="mt-2">Belum ada data buku.</div></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-5 d-flex flex-column gap-4">
            {{-- Buku per kategori --}}
            <div class="card">
                <div class="card-header"><i class="bi bi-bar-chart-fill me-2" style="color:var(--sage-dark)"></i>Buku per Kategori</div>
                <div class="card-body">
                    @forelse ($categoryStats as $cat)
                        @php $percent = $totalBooks > 0 ? round($cat->books_count / $totalBooks * 100) : 0; @endphp
                        <div class="{{ $loop->last ? '' : 'mb-4' }}">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-medium">{{ $cat->name }}</span>
                                <span class="text-secondary">{{ $cat->books_count }} buku</span>
                            </div>
                            <div class="progress"><div class="progress-bar" style="width: {{ $percent }}%"></div></div>
                        </div>
                    @empty
                        <div class="text-secondary">Belum ada kategori.</div>
                    @endforelse
                </div>
            </div>

            {{-- Stok menipis --}}
            <div class="card">
                <div class="card-header"><i class="bi bi-exclamation-triangle-fill me-2" style="color:#84621f"></i>Perlu Restok</div>
                <ul class="list-group list-group-flush">
                    @forelse ($lowStockBooks as $book)
                        <li class="list-group-item d-flex align-items-center justify-content-between gap-3">
                            <div>
                                <a href="{{ route('books.edit', $book) }}" class="book-title">{{ $book->title }}</a>
                                <div class="small text-secondary mt-1">{{ $book->category->name }}</div>
                            </div>
                            <span class="{{ $book->stockBadgeClass() }}">{{ $book->stock === 0 ? 'Habis' : 'Sisa ' . $book->stock }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-secondary py-4"><i class="bi bi-check-circle me-1" style="color:#2f6b4b"></i>Semua stok aman.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
