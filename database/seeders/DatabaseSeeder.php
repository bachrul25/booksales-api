<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AuthorsTableSeeder::class,
            BooksTableSeeder::class,
            GenreSeeder::class,
        ]);
    }
}
