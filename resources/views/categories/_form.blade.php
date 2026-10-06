@csrf

<div class="row g-3">
    <div class="col-12">
        <label for="name" class="form-label fw-medium">Nama Kategori <span class="text-danger">*</span></label>
        <div class="input-group has-validation">
            <span class="input-group-text"><i class="bi bi-tag"></i></span>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name ?? '') }}"
                   class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Teknologi" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col-12">
        <label for="description" class="form-label fw-medium">Deskripsi</label>
        <textarea id="description" name="description" rows="4"
                  class="form-control @error('description') is-invalid @enderror"
                  placeholder="Penjelasan singkat tentang kategori ini (opsional)">{{ old('description', $category->description ?? '') }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<hr class="my-4">

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check2-circle me-1"></i> Simpan</button>
    <a href="{{ route('categories.index') }}" class="btn btn-light px-4">Batal</a>
</div>
