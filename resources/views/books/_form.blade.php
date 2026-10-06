@csrf

<div class="row g-4">
    <div class="col-12">
        <label for="title" class="form-label">Judul Buku <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
            <span class="input-group-text"><i class="bi bi-book"></i></span>
            <input type="text" id="title" name="title" value="{{ old('title', $book->title ?? '') }}"
                   class="form-control @error('title') is-invalid @enderror" placeholder="Contoh: Pemrograman Web dengan Laravel" required>
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-6">
        <label for="author" class="form-label">Penulis <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" id="author" name="author" value="{{ old('author', $book->author ?? '') }}"
                   class="form-control @error('author') is-invalid @enderror" placeholder="Nama penulis" required>
            @error('author') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-6">
        <label for="publisher" class="form-label">Penerbit <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
            <span class="input-group-text"><i class="bi bi-building"></i></span>
            <input type="text" id="publisher" name="publisher" value="{{ old('publisher', $book->publisher ?? '') }}"
                   class="form-control @error('publisher') is-invalid @enderror" placeholder="Nama penerbit" required>
            @error('publisher') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-4">
        <label for="year" class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
            <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
            <input type="number" id="year" name="year" value="{{ old('year', $book->year ?? '') }}"
                   class="form-control @error('year') is-invalid @enderror" placeholder="{{ date('Y') }}" required>
            @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-4">
        <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
            <span class="input-group-text"><i class="bi bi-stack"></i></span>
            <input type="number" id="stock" name="stock" min="0" value="{{ old('stock', $book->stock ?? 0) }}"
                   class="form-control @error('stock') is-invalid @enderror" required>
            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-md-4">
        <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
            <span class="input-group-text"><i class="bi bi-tag"></i></span>
            <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                <option value="">-- Pilih kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id ?? '') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<hr class="my-5" style="border-color:var(--border); opacity:1;">

<div class="d-flex flex-wrap gap-3">
    <button type="submit" class="btn btn-primary btn-lg px-5"><i class="bi bi-check2-circle"></i> Simpan</button>
    <a href="{{ route('books.index') }}" class="btn btn-outline-neutral btn-lg px-5">Batal</a>
</div>
