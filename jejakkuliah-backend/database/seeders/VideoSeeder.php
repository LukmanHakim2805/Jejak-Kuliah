<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\User;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $videos = [
            'Pemrograman C (Dasar)',
            'Belajar Java (Dasar)',
            'Belajar C++ (Dasar)',
            'Belajar Python (Dasar)',
            'Belajar HTML (Dasar)',
            'Belajar CSS (Dasar)',
            'Belajar Javascript (Dasar)',
            'Koneksi Winbox dan Internet Pada Mikrotik dalam GNS3VM',
        ];

        foreach ($videos as $title) {
            Video::create([
                'user_id' => $user->id,
                'title' => $title,
                'url' => 'https://www.youtube.com/watch?v=example',
                'platform' => 'youtube',
            ]);
        }
    }
}
