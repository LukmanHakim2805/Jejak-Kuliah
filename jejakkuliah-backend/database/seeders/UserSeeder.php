<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'luukmaanhaakiim33@gmail.com
            [
                'name' => 'Lukman
                'password' => Hash::make('Lukman_Hkm01'),
            ]
        );
    }
}
