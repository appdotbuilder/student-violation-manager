<?php

namespace Database\Seeders;

use App\Models\ViolationCategory;
use Illuminate\Database\Seeder;

class ViolationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Disiplin',
                'description' => 'Pelanggaran terkait kedisiplinan siswa seperti keterlambatan dan kehadiran',
                'status' => 'active',
            ],
            [
                'name' => 'Seragam',
                'description' => 'Pelanggaran terkait kelengkapan dan kerapian seragam sekolah',
                'status' => 'active',
            ],
            [
                'name' => 'Akademik',
                'description' => 'Pelanggaran terkait kegiatan belajar mengajar dan tugas sekolah',
                'status' => 'active',
            ],
            [
                'name' => 'Ketertiban',
                'description' => 'Pelanggaran terkait ketertiban dan keamanan di lingkungan sekolah',
                'status' => 'active',
            ],
            [
                'name' => 'Sopan Santun',
                'description' => 'Pelanggaran terkait etika, sopan santun, dan moral siswa',
                'status' => 'active',
            ],
        ];

        foreach ($categories as $category) {
            ViolationCategory::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}