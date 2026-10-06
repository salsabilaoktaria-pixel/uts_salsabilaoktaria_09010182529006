@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <div class="page-header">
        <div>
            <h1>Daftar Buku</h1>
            <p>Kelola seluruh koleksi buku perpustakaan.</p>
        </div>
        <a href="{{ route('books.create') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-lg"></i> Tambah Buku
        </a>
    </div>

    {{-- Bonus: pencarian judul/penulis dan filter kategori --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('books.index') }}" class="row g-3 align-items-end">
                <div class="col-lg-5">
                    <label for="q" class="form-label">Cari judul atau penulis</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" id="q" name="q" value="{{ request('q') }}" class="form-control"
                               placeholder="Ketik judul atau nama penulis...">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label for="category" class="form-label">Filter kategori</label>
                    <select id="category" name="category" class="form-select">
                        <option value="">Semua kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill"><i class="bi bi-search"></i> Cari</button>
                    @if (request('q') || request('category'))
                        <a href="{{ route('books.index') }}" class="btn btn-outline-neutral flex-fill"><i class="bi bi-x-lg"></i> Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
            <span><i class="bi bi-table me-2" style="color:var(--sage-dark)"></i>Data Buku</span>
            <span class="text-secondary fw-normal" style="font-size:15px;">
                @if ($books->total() > 0)
                    Menampilkan {{ $books->firstItem() }}-{{ $books->lastItem() }} dari {{ $books->total() }} buku
                @else
                    0 buku ditemukan
                @endif
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width:70px;">No</th>
                        <th style="min-width:220px;">Judul</th>
                        <th style="min-width:160px;">Penulis</th>
                        <th style="min-width:160px;">Penerbit</th>
                        <th class="text-center">Tahun</th>
                        <th>Kategori</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center" style="min-width:290px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td class="text-secondary">{{ $books->firstItem() + $loop->index }}</td>
                            <td><a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a></td>
                            <td>{{ $book->author }}</td>
                            <td class="text-secondary">{{ $book->publisher }}</td>
                            <td class="text-center">{{ $book->year }}</td>
                            <td><span class="pill cat">{{ $book->category->name }}</span></td>
                            <td class="text-center"><span class="{{ $book->stockBadgeClass() }}">{{ $book->stock }}</span></td>
                            <td class="text-center">
                                <div class="row-actions">
                                    <a href="{{ route('books.show', $book) }}" class="btn btn-soft-sage btn-sm"><i class="bi bi-eye"></i> Detail</a>
                                    <a href="{{ route('books.edit', $book) }}" class="btn btn-soft-gold btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <button type="button" class="btn btn-soft-rose btn-sm"
                                            data-delete-url="{{ route('books.destroy', $book) }}"
                                            data-delete-name="{{ $book->title }}">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="bi bi-search"></i>
                                    <div class="fw-semibold mt-3" style="font-size:18px;">Buku tidak ditemukan</div>
                                    <div class="mt-1">Coba ubah kata kunci atau filter kategori.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($books->hasPages())
            <div class="card-footer d-flex justify-content-end">
                {{ $books->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
