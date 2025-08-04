<?php

namespace Database\Seeders;

use App\Models\ViolationCategory;
use App\Models\ViolationType;
use Illuminate\Database\Seeder;

class ViolationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $violationTypes = [
            // Disiplin
            'Disiplin' => [
                ['name' => 'Terlambat', 'description' => 'Datang terlambat ke sekolah', 'points' => 5],
                ['name' => 'Tidak Masuk Tanpa Keterangan', 'description' => 'Tidak hadir tanpa izin yang jelas', 'points' => 20],
                ['name' => 'Meninggalkan Kelas Tanpa Izin', 'description' => 'Keluar kelas saat jam pelajaran berlangsung', 'points' => 15],
                ['name' => 'Tidak Mengikuti Upacara', 'description' => 'Tidak hadir dalam upacara bendera', 'points' => 10],
            ],
            
            // Seragam
            'Seragam' => [
                ['name' => 'Tidak Memakai Atribut Lengkap', 'description' => 'Seragam tidak lengkap sesuai aturan', 'points' => 10],
                ['name' => 'Berpakaian Tidak Rapi', 'description' => 'Seragam tidak rapi atau tidak sesuai aturan', 'points' => 5],
                ['name' => 'Tidak Memakai Sepatu Hitam', 'description' => 'Memakai sepatu selain warna hitam', 'points' => 8],
                ['name' => 'Tidak Memakai Kaos Kaki Putih', 'description' => 'Kaos kaki tidak putih atau tidak dipakai', 'points' => 5],
            ],
            
            // Akademik
            'Akademik' => [
                ['name' => 'Tidak Mengerjakan Tugas', 'description' => 'Tidak menyelesaikan tugas yang diberikan guru', 'points' => 15],
                ['name' => 'Tidur di Kelas', 'description' => 'Tidur saat proses pembelajaran berlangsung', 'points' => 10],
                ['name' => 'Tidak Membawa Buku Pelajaran', 'description' => 'Tidak membawa buku yang diperlukan', 'points' => 8],
                ['name' => 'Mengganggu Proses Belajar', 'description' => 'Mengganggu konsentrasi kelas saat pelajaran', 'points' => 20],
            ],
            
            // Ketertiban
            'Ketertiban' => [
                ['name' => 'Berkelahi', 'description' => 'Terlibat perkelahian dengan siswa lain', 'points' => 50],
                ['name' => 'Merokok', 'description' => 'Merokok di area sekolah', 'points' => 30],
                ['name' => 'Membawa Barang Terlarang', 'description' => 'Membawa barang yang tidak diperbolehkan', 'points' => 25],
                ['name' => 'Merusak Fasilitas Sekolah', 'description' => 'Merusak properti atau fasilitas sekolah', 'points' => 40],
            ],
            
            // Sopan Santun
            'Sopan Santun' => [
                ['name' => 'Tidak Hormat kepada Guru', 'description' => 'Bersikap tidak sopan terhadap guru', 'points' => 30],
                ['name' => 'Berkata Kasar', 'description' => 'Menggunakan bahasa yang tidak pantas', 'points' => 20],
                ['name' => 'Menggunakan HP di Kelas', 'description' => 'Menggunakan handphone saat jam pelajaran', 'points' => 15],
                ['name' => 'Tidak Mengucapkan Salam', 'description' => 'Tidak menyapa guru saat bertemu', 'points' => 5],
            ],
        ];

        foreach ($violationTypes as $categoryName => $types) {
            $category = ViolationCategory::where('name', $categoryName)->first();
            
            if ($category) {
                foreach ($types as $type) {
                    ViolationType::firstOrCreate(
                        [
                            'violation_category_id' => $category->id,
                            'name' => $type['name']
                        ],
                        [
                            'description' => $type['description'],
                            'points' => $type['points'],
                            'status' => 'active',
                        ]
                    );
                }
            }
        }
    }
}