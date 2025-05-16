<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    public function run()
    {
        Author::create([
            'name' => 'J.K. Rowling',
            'email' => 'jkrowling@example.com',
            'bio' => 'British author best known for the Harry Potter series.'
        ]);

        Author::create([
            'name' => 'George R.R. Martin',
            'email' => 'grrmartin@example.com',
            'bio' => 'American novelist and short-story writer, known for A Song of Ice and Fire.'
        ]);

        Author::create([
            'name' => 'Stephen King',
            'email' => 'sking@example.com',
            'bio' => 'American author of horror, supernatural fiction, suspense, and fantasy novels.'
        ]);

        Author::create([
            'name' => 'Agatha Christie',
            'email' => 'achristie@example.com',
            'bio' => 'English writer known for her detective novels.'
        ]);

        Author::create([
            'name' => 'J.R.R. Tolkien',
            'email' => 'tolkien@example.com',
            'bio' => 'English writer, poet, philologist, and academic, best known for The Hobbit and The Lord of the Rings.'
        ]);
    }
}
