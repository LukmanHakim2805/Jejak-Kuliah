<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Models\User;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $semesters = [
            ['name' => 'Semester 1', 'semester_number' => 1, 'academic_year' => 2023],
            ['name' => 'Semester 2', 'semester_number' => 2, 'academic_year' => 2023],
            ['name' => 'Semester 3', 'semester_number' => 3, 'academic_year' => 2024],
            ['name' => 'Semester 4', 'semester_number' => 4, 'academic_year' => 2024],
        ];

        foreach ($semesters as $semester) {
            Semester::create([
                'user_id' => $user->id,
                'name' => $semester['name'],
                'semester_number' => $semester['semester_number'],
                'academic_year' => $semester['academic_year'],
                'status' => 'active',
            ]);
        }
    }
}
