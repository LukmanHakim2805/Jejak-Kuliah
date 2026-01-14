<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Course;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        $basisData = Course::where('name', 'Basis Data')->first();
        $jaringan = Course::where('name', 'Jaringan Komputer')->first();
        $pbo = Course::where('name', 'Pemrograman Berorientasi Objek')->first();
        $matematika = Course::where('name', 'Matematika & Komputasi')->first();
        $statistika = Course::where('name', 'Statistika Komputasi')->first();

        $materials = [
            [
                'course_id' => $basisData->id,
                'name' => 'Normalisasi.pptx',
                'type' => 'lecture',
                'file_type' => 'pptx',
            ],
            [
                'course_id' => $jaringan->id,
                'name' => 'Routing Statis.pdf',
                'type' => 'lecture',
                'file_type' => 'pdf',
            ],
            [
                'course_id' => $jaringan->id,
                'name' => 'Routing Dinamis.pdf',
                'type' => 'lecture',
                'file_type' => 'pdf',
            ],
            [
                'course_id' => $pbo->id,
                'name' => 'Constructor & Destructor.pptx',
                'type' => 'lecture',
                'file_type' => 'pptx',
            ],
            [
                'course_id' => $pbo->id,
                'name' => 'Java Array.pptx',
                'type' => 'lecture',
                'file_type' => 'pptx',
            ],
            [
                'course_id' => $matematika->id,
                'name' => 'Transformasi Geometri Sederhana.pptx',
                'type' => 'lecture',
                'file_type' => 'pptx',
            ],
            [
                'course_id' => $statistika->id,
                'name' => 'P4 Penyajian Data.pdf',
                'type' => 'lecture',
                'file_type' => 'pdf',
            ],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
