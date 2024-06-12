<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $faker->seed(35);
        $faker->addProvider(new BookFake($faker));
        $faker->addProvider(new Faker\Provider\id_ID\Person($faker));

        DB::table('book')->insert([
            'title' => $faker->title(),
            'isbn' => $faker->ISBN(),
        ]);
    }
}
