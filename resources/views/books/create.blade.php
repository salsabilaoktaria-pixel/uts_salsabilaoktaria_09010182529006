@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <div class="page-header">
        <div>
            <h1>Tambah Buku</h1>
            <p>Isi data buku baru dengan lengkap.</p>
        </div>
        <a href="{{ route('books.index') }}" class="btn btn-outline-neutral"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    <div class="card">
        <div class="card-header"><i class="bi bi-journal-plus me-2" style="color:var(--sage-dark)"></i>Form Tambah Buku</div>
        <div class="card-body" style="padding:36px;">
            <form method="POST" action="{{ route('books.store') }}" novalidate>
                @include('books._form')
            </form>
        </div>
    </div>
@endsection
