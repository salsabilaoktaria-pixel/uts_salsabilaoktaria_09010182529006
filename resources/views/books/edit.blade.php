@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <div class="page-header">
        <div>
            <h1>Edit Buku</h1>
            <p>Perbarui data untuk <strong>{{ $book->title }}</strong>.</p>
        </div>
        <a href="{{ route('books.index') }}" class="btn btn-outline-neutral"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    <div class="card">
        <div class="card-header"><i class="bi bi-pencil-square me-2" style="color:#84621f"></i>Form Edit Buku</div>
        <div class="card-body" style="padding:36px;">
            <form method="POST" action="{{ route('books.update', $book) }}" novalidate>
                @method('PUT')
                @include('books._form')
            </form>
        </div>
    </div>
@endsection
