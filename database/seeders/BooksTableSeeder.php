<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        // First create books without genres
        $books = [
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author_id' => 1,
                'description' => 'The first novel in the Harry Potter series.',
                'published_date' => '1997-06-26'
            ],
            [
                'title' => 'A Game of Thrones',
                'author_id' => 2,
                'description' => 'The first book in A Song of Ice and Fire series.',
                'published_date' => '1996-08-01'
            ],
            [
                'title' => 'The Shining',
                'author_id' => 3,
                'description' => 'A horror novel about a haunted hotel.',
                'published_date' => '1977-01-28'
            ],
            [
                'title' => 'Murder on the Orient Express',
                'author_id' => 4,
                'description' => 'A detective novel featuring Hercule Poirot.',
                'published_date' => '1934-01-01'
            ],
            [
                'title' => 'The Hobbit',
                'author_id' => 5,
                'description' => 'Fantasy novel about the adventures of Bilbo Baggins.',
                'published_date' => '1937-09-21'
            ]
        ];

        foreach ($books as $bookData) {
            // Create the book
            $book = Book::create([
                'title' => $bookData['title'],
                'author_id' => $bookData['author_id'],
                'description' => $bookData['description'],
                'published_date' => Carbon::parse($bookData['published_date'])
            ]);

            // Attach random genres (1-3 genres per book)
            $genres = Genre::inRandomOrder()
                ->limit(rand(1, 3))
                ->pluck('id')
                ->toArray();

            if (count($genres) > 0) {
                $book->genres()->attach($genres);
            }
        }
    }
}
