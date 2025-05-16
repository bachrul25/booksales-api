<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'title' => 'Harry Potter and the Philosopher\'s Stone',
            'author_id' => 1,
            'description' => 'The first novel in the Harry Potter series.',
            'published_date' => '1997-06-26'
        ]);

        Book::create([
            'title' => 'A Game of Thrones',
            'author_id' => 2,
            'description' => 'The first book in A Song of Ice and Fire series.',
            'published_date' => '1996-08-01'
        ]);

        Book::create([
            'title' => 'The Shining',
            'author_id' => 3,
            'description' => 'A horror novel about a haunted hotel.',
            'published_date' => '1977-01-28'
        ]);

        Book::create([
            'title' => 'Murder on the Orient Express',
            'author_id' => 4,
            'description' => 'A detective novel featuring Hercule Poirot.',
            'published_date' => '1934-01-01'
        ]);

        Book::create([
            'title' => 'The Hobbit',
            'author_id' => 5,
            'description' => 'Fantasy novel about the adventures of Bilbo Baggins.',
            'published_date' => '1937-09-21'
        ]);
    }
}
