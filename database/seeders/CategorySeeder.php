<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Teknologi', 'description' => 'Buku seputar pemrograman, komputer, dan teknologi informasi.'],
            ['name' => 'Fiksi', 'description' => 'Novel dan karya sastra fiksi.'],
            ['name' => 'Sains', 'description' => 'Buku ilmu pengetahuan alam dan sains populer.'],
            ['name' => 'Sejarah', 'description' => 'Buku sejarah dunia dan sejarah Indonesia.'],
            ['name' => 'Bisnis & Pengembangan Diri', 'description' => 'Buku bisnis, keuangan, dan pengembangan diri.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}
