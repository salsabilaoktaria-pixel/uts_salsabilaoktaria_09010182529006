<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // akses sudah dibatasi middleware auth pada route
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'between:1000,' . date('Y')],
            'stock' => ['required', 'integer', 'min:0', 'max:100000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'Kategori',
            'title' => 'Judul',
            'author' => 'Penulis',
            'publisher' => 'Penerbit',
            'year' => 'Tahun terbit',
            'stock' => 'Stok',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'integer' => ':attribute harus berupa angka bulat.',
            'max' => ':attribute maksimal :max.',
            'min' => ':attribute minimal :min.',
            'between' => ':attribute harus antara :min dan :max.',
            'exists' => ':attribute yang dipilih tidak valid.',
        ];
    }
}
