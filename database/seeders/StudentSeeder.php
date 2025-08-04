<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            'X IPA 1', 'X IPA 2', 'X IPS 1', 'X IPS 2',
            'XI IPA 1', 'XI IPA 2', 'XI IPS 1', 'XI IPS 2',
            'XII IPA 1', 'XII IPA 2', 'XII IPS 1', 'XII IPS 2'
        ];

        // Create students for each class
        foreach ($classes as $class) {
            // Create 25-30 students per class
            $studentCount = fake()->numberBetween(25, 30);
            
            for ($i = 1; $i <= $studentCount; $i++) {
                $studentId = $this->generateStudentId($class, $i);
                
                Student::firstOrCreate(
                    ['student_id' => $studentId],
                    [
                        'name' => fake()->name(),
                        'class' => $class,
                        'total_points' => 0,
                        'status' => fake()->randomElement(['active', 'active', 'active', 'active', 'inactive']), // 80% active
                    ]
                );
            }
        }
    }

    /**
     * Generate student ID based on class and sequence.
     *
     * @param string $class
     * @param int $sequence
     * @return string
     */
    public function generateStudentId(string $class, int $sequence): string
    {
        // Extract grade level (X, XI, XII)
        $grade = substr($class, 0, strpos($class, ' '));
        
        // Convert grade to number
        $gradeMap = ['X' => '10', 'XI' => '11', 'XII' => '12'];
        $gradeNumber = $gradeMap[$grade] ?? '10';
        
        // Extract class type and number
        if (strpos($class, 'IPA') !== false) {
            $classType = '1'; // IPA
            $classNumber = substr($class, -1);
        } else {
            $classType = '2'; // IPS
            $classNumber = substr($class, -1);
        }
        
        // Format: YYCTNN (YY=grade, C=class_type, T=class_number, NN=sequence)
        return sprintf('%s%s%s%02d', $gradeNumber, $classType, $classNumber, $sequence);
    }
}