@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="page-header">
        <div>
            <h1>Kategori Buku</h1>
            <p>Satu kategori dapat memiliki banyak buku.</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Jumlah Buku</th>
                        <th class="text-center" style="width:130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td class="text-secondary">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td class="text-secondary">{{ \Illuminate\Support\Str::limit($category->description, 80) ?: '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('books.index', ['category' => $category->id]) }}" class="badge badge-cat text-decoration-none">
                                    {{ $category->books_count }} buku
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-icon btn-outline-warning" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    <button type="button" class="btn btn-icon btn-outline-danger" title="Hapus"
                                            data-delete-url="{{ route('categories.destroy', $category) }}"
                                            data-delete-name="{{ $category->name }}">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state"><i class="bi bi-tags"></i><div class="mt-2">Belum ada kategori.</div></div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
