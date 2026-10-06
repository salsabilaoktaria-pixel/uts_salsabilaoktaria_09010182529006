@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
    <div class="page-header">
        <div>
            <h1>Detail Buku</h1>
            <p>Informasi lengkap buku.</p>
        </div>
        <a href="{{ route('books.index') }}" class="btn btn-outline-neutral"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-body" style="padding:36px;">
                    <span class="pill cat mb-3">{{ $book->category->name }}</span>
                    <h2 class="mb-2" style="font-size:30px;">{{ $book->title }}</h2>
                    <p class="text-secondary mb-5">oleh {{ $book->author }}</p>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="detail-label">Judul</div>
                            <div class="detail-value">{{ $book->title }}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-label">Penulis</div>
                            <div class="detail-value">{{ $book->author }}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-label">Penerbit</div>
                            <div class="detail-value">{{ $book->publisher }}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-label">Tahun Terbit</div>
                            <div class="detail-value">{{ $book->year }}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-label">Kategori</div>
                            <div class="detail-value">{{ $book->category->name }}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-label">Stok</div>
                            <div class="detail-value">{{ $book->stock }} buku</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-label">Ditambahkan</div>
                            <div class="detail-value mb-0">{{ $book->created_at->locale('id')->translatedFormat('d F Y, H:i') }}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="detail-label">Terakhir diubah</div>
                            <div class="detail-value mb-0">{{ $book->updated_at->locale('id')->translatedFormat('d F Y, H:i') }}</div>
                        </div>
                    </div>

                    @if ($book->category->description)
                        <div class="mt-5 p-4 rounded-4 text-secondary" style="background:var(--sand);border:1px solid var(--border);">
                            <i class="bi bi-info-circle me-1"></i><strong>Tentang kategori:</strong> {{ $book->category->description }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4 d-flex flex-column gap-4">
            <div class="card">
                <div class="card-body text-center" style="padding:36px;">
                    <div class="detail-label">Stok Tersedia</div>
                    <div class="stock-big my-3">{{ $book->stock }}</div>
                    <span class="{{ $book->stockBadgeClass() }}">{{ $book->stockLabel() }}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-body d-grid gap-3" style="padding:28px;">
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-soft-gold btn-lg"><i class="bi bi-pencil-square"></i> Edit Buku</a>
                    <button type="button" class="btn btn-soft-rose btn-lg"
                            data-delete-url="{{ route('books.destroy', $book) }}"
                            data-delete-name="{{ $book->title }}">
                        <i class="bi bi-trash3"></i> Hapus Buku
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
