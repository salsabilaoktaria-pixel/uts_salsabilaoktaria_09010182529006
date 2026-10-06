<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Read: daftar buku.
     * Bonus: pencarian berdasarkan judul/penulis dan filter berdasarkan kategori.
     */
    public function index(Request $request): View
    {
        $books = Book::with('category')
            ->search($request->query('q'))
            ->ofCategory($request->query('category'))
            ->latest()
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('books.index', [
            'books' => $books,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    /**
     * Create: form tambah buku.
     */
    public function create(): View
    {
        return view('books.create', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    /**
     * Create: simpan buku baru.
     */
    public function store(BookRequest $request): RedirectResponse
    {
        $book = Book::create($request->validated());

        return redirect()->route('books.index')
            ->with('success', "Buku \"{$book->title}\" berhasil ditambahkan.");
    }

    /**
     * Detail: tampilkan satu buku.
     */
    public function show(Book $book): View
    {
        $book->load('category');

        return view('books.show', compact('book'));
    }

    /**
     * Update: form edit buku.
     */
    public function edit(Book $book): View
    {
        return view('books.edit', [
            'book' => $book,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    /**
     * Update: simpan perubahan buku.
     */
    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->validated());

        return redirect()->route('books.index')
            ->with('success', "Buku \"{$book->title}\" berhasil diperbarui.");
    }

    /**
     * Delete: hapus buku.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $title = $book->title;
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', "Buku \"{$title}\" berhasil dihapus.");
    }
}
