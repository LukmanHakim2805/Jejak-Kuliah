<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Semester;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $semester3 = Semester::firstOrCreate(
            ['semester_number' => 3],
            [
                'name' => 'Semester 3',
                'academic_year' => '2025/2026',
            ]
        );

        $courses = [
            [
                'name' => 'Basis Data',
                'code' => 'CS301',
                'credits' => 3,
                'lecturer' => 'Dr. Budi Santoso',
            ],
            [
                'name' => 'Jaringan Komputer',
                'code' => 'CS302',
                'credits' => 3,
                'lecturer' => 'Prof. Ani Widya',
            ],
            [
                'name' => 'Pemrograman Berorientasi Objek',
                'code' => 'CS303',
                'credits' => 4,
                'lecturer' => 'Dr. Citra Dewi',
            ],
            [
                'name' => 'Matematika & Komputasi',
                'code' => 'MTK301',
                'credits' => 3,
                'lecturer' => 'Dr. Dwi Kurniawan',
            ],
            [
                'name' => 'Statistika Komputasi',
                'code' => 'ST301',
                'credits' => 3,
                'lecturer' => 'Dr. Eka Putri',
            ],
        ];

        foreach ($courses as $course) {
            Course::create([
                'semester_id' => $semester3->id,
                'name'        => $course['name'],
                'code'        => $course['code'],
                'credits'     => $course['credits'],
                'lecturer'    => $course['lecturer'],
            ]);
        }
    }
}
