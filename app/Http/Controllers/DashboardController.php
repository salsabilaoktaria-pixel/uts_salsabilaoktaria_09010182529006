<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'totalBooks' => Book::count(),
            'totalCategories' => Category::count(),
            'totalStock' => (int) Book::sum('stock'),
            'lowStockCount' => Book::lowStock()->count(),
            'latestBooks' => Book::with('category')->latest()->orderByDesc('id')->take(5)->get(),
            'lowStockBooks' => Book::with('category')->lowStock()->orderBy('stock')->orderBy('title')->take(5)->get(),
            'categoryStats' => Category::withCount('books')->orderByDesc('books_count')->orderBy('name')->get(),
        ]);
    }
}
