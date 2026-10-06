@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="page-header">
        <div>
            <h1>Edit Kategori</h1>
            <p>Perbarui kategori <strong>{{ $category->name }}</strong>.</p>
        </div>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
    </div>

    <div class="card" style="max-width:720px;">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('categories.update', $category) }}" novalidate>
                @method('PUT')
                @include('categories._form')
            </form>
        </div>
    </div>
@endsection
