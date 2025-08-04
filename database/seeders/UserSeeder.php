<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default administrator
        User::firstOrCreate(
            ['email' => 'admin@school.edu'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'administrator',
                'phone' => '021-1234567',
                'address' => 'Jl. Pendidikan No. 123, Jakarta',
                'email_verified_at' => now(),
            ]
        );

        // Create default teachers
        $teachers = [
            [
                'name' => 'Guru Matematika',
                'email' => 'math.teacher@school.edu',
                'phone' => '021-2345678',
            ],
            [
                'name' => 'Guru Bahasa Indonesia',
                'email' => 'indo.teacher@school.edu',
                'phone' => '021-3456789',
            ],
            [
                'name' => 'Guru Bahasa Inggris',
                'email' => 'english.teacher@school.edu',
                'phone' => '021-4567890',
            ],
            [
                'name' => 'Guru IPA',
                'email' => 'science.teacher@school.edu',
                'phone' => '021-5678901',
            ],
            [
                'name' => 'Guru IPS',
                'email' => 'social.teacher@school.edu',
                'phone' => '021-6789012',
            ],
        ];

        foreach ($teachers as $teacher) {
            User::firstOrCreate(
                ['email' => $teacher['email']],
                [
                    'name' => $teacher['name'],
                    'password' => Hash::make('password'),
                    'role' => 'teacher',
                    'phone' => $teacher['phone'],
                    'address' => 'Jl. Guru No. ' . fake()->numberBetween(1, 100) . ', Jakarta',
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}