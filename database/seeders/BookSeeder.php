<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\fakes\BookFake;
use Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();
        $faker->seed(rand());
        $faker->addProvider(new BookFake($faker));
        $faker->addProvider(new Faker\Provider\id_ID\Person($faker));

        Book::create([
            'title' => $faker->bookTitle(),
            'author' => $faker->name(),
            'description' => $faker->text(),
            'publisher' => $faker->company(),
            'cover' => ['tere-liye.jpeg', 'sang-pemimpi.jpeg', 'negeri_5_menara.jpeg', '1717947023.jpg', ][rand(0, 3)],
            'publishing_year' => $faker->year(max: now()),
            'stock' => $faker->randomNumber(),
            'isbn' => $faker->isbn(),
            'language' => $faker->languageCode(),
        ]);
    }
}
