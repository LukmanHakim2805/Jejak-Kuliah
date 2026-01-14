<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
{
    $user = User::first();

    if (!$user) {
        $user = User::factory()->create();
    }

    $books = [
        [
            'title' => 'Clean Code',
            'author' => 'Robert C. Martin',
            'publisher' => 'Prentice Hall',
            'publication_year' => 2008,
        ],
        [
            'title' => 'The Pragmatic Programmer',
            'author' => 'Andrew Hunt & David Thomas',
            'publisher' => 'Addison-Wesley',
            'publication_year' => 1999,
        ],
        [
            'title' => 'Artificial Intelligence: A Modern Approach',
            'author' => 'Stuart Russell & Peter Norvig',
            'publisher' => 'Pearson',
            'publication_year' => 2020,
        ],
    ];

    foreach ($books as $book) {
        Book::create([
            'user_id' => $user->id,
            'title' => $book['title'],
            'author' => $book['author'],
            'publisher' => $book['publisher'],
            'publication_year' => $book['publication_year'],
        ]);
    }
}

}