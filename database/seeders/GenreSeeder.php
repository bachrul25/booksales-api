<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run()
    {
        $genres = [
            ['name' => 'Fiction', 'description' => 'Works of imaginative narration'],
            ['name' => 'Non-Fiction', 'description' => 'Prose writing that is informative or factual'],
            ['name' => 'Science Fiction', 'description' => 'Fiction dealing with futuristic concepts'],
            ['name' => 'Fantasy', 'description' => 'Fiction with magic or supernatural elements'],
            ['name' => 'Mystery', 'description' => 'Fiction dealing with solving a crime'],
            ['name' => 'Romance', 'description' => 'Fiction focusing on love relationships'],
            ['name' => 'Horror', 'description' => 'Fiction intended to scare or shock'],
            ['name' => 'Biography', 'description' => 'Non-fiction account of a person\'s life'],
            ['name' => 'History', 'description' => 'Non-fiction study of past events'],
            ['name' => 'Self-Help', 'description' => 'Non-fiction aimed at personal improvement'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
