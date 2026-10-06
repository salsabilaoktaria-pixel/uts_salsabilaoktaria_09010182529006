<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $categoryId = Category::pluck('id', 'name');

        $books = [
            // Teknologi
            ['Teknologi', 'Pemrograman Web dengan Laravel', 'Budi Santoso', 'Informatika', 2022, 8],
            ['Teknologi', 'Basis Data Relasional', 'Siti Rahma', 'Andi Offset', 2020, 5],
            ['Teknologi', 'Clean Code', 'Robert C. Martin', 'Prentice Hall', 2008, 2],
            ['Teknologi', 'Algoritma dan Struktur Data', 'Rinaldi Munir', 'Informatika', 2016, 6],
            // Fiksi
            ['Fiksi', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 12],
            ['Fiksi', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 6],
            ['Fiksi', 'Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia Pustaka Utama', 2009, 9],
            ['Fiksi', 'Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', 'Republika', 2004, 0],
            // Sains
            ['Sains', 'Sejarah Singkat Waktu', 'Stephen Hawking', 'Gramedia Pustaka Utama', 2018, 4],
            ['Sains', 'Cosmos', 'Carl Sagan', 'Random House', 1980, 3],
            ['Sains', 'Astrofisika untuk Orang Sibuk', 'Neil deGrasse Tyson', 'Gramedia Pustaka Utama', 2018, 7],
            // Sejarah
            ['Sejarah', 'Sapiens', 'Yuval Noah Harari', 'KPG', 2017, 10],
            ['Sejarah', 'Sejarah Indonesia Modern', 'M.C. Ricklefs', 'Serambi', 2008, 1],
            // Bisnis & Pengembangan Diri
            ['Bisnis & Pengembangan Diri', 'Atomic Habits', 'James Clear', 'Gramedia Pustaka Utama', 2019, 15],
            ['Bisnis & Pengembangan Diri', 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', 'Gramedia Pustaka Utama', 2011, 11],
            ['Bisnis & Pengembangan Diri', 'Filosofi Teras', 'Henry Manampiring', 'Kompas', 2018, 8],
        ];

        foreach ($books as [$category, $title, $author, $publisher, $year, $stock]) {
            Book::updateOrCreate(
                ['title' => $title, 'author' => $author],
                [
                    'category_id' => $categoryId[$category],
                    'publisher' => $publisher,
                    'year' => $year,
                    'stock' => $stock,
                ]
            );
        }
    }
}
