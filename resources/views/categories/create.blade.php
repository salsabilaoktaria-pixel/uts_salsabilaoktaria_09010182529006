@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="page-header">
        <div>
            <h1>Tambah Kategori</h1>
            <p>Buat kategori baru untuk mengelompokkan buku.</p>
        </div>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
    </div>

    <div class="card" style="max-width:720px;">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('categories.store') }}" novalidate>
                @include('categories._form')
            </form>
        </div>
    </div>
@endsection
