<?php
namespace Database\Seeders;

use App\Models\Journal;
use App\Models\User;
use Illuminate\Database\Seeder;

class JournalSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $journals = [
            [
                'title' => 'A Systematic Review of Learning Analytics',
                'journal_name' => 'Educational Technology Research',
            ],
            [
                'title' => 'IEEE Transactions on Computers',
                'journal_name' => 'IEEE Computer Society',
            ],
            [
                'title' => 'ACM Computing Surveys',
                'journal_name' => 'Association for Computing Machinery',
            ],
        ];

        foreach ($journals as $journal) {
            Journal::create([
                'user_id' => $user->id,
                'title' => $journal['title'],
                'journal_name' => $journal['journal_name'],
            ]);
        }
    }
}
