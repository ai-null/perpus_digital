<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\fakes\BookFake;
use Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();
        $bookCategories = [
            'Fiksi',
            'Non-Fiksi',
            'Misteri',
            'Thriller',
            'Horor',
            'Fantasi',
            'Fiksi Ilmiah',
            'Fiksi Sejarah',
            'Romansa',
            'Dewasa Muda',
            'Anak-anak',
            'Biografi',
            'Otobiografi',
            'Puisi',
            'Drama',
            'Petualangan',
            'Komik',
            'Esai',
            'Agama',
            'Filsafat',
            'Psikologi',
            'Sains',
            'Teknologi',
            'Politik',
            'Sosial',
            'Ekonomi',
            'Bisnis',
            'Seni',
            'Musik',
            'Fotografi',
            'Memasak',
            'Perjalanan',
            'Kesehatan',
            'Kebugaran',
            'Keluarga',
            'Hobi',
            'Kerajinan',
            'Gaya Hidup',
            'Olahraga',
            'Sejarah'
        ];

        foreach ($bookCategories as $category) {
            Category::create([
                'category' => $category
            ]);
        }
    }
}
