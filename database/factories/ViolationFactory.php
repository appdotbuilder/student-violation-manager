<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use App\Models\ViolationCategory;
use App\Models\ViolationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Violation>
 */
class ViolationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $violationType = ViolationType::inRandomOrder()->first() ?? ViolationType::factory()->create();
        
        return [
            'student_id' => Student::factory(),
            'violation_category_id' => $violationType->violation_category_id,
            'violation_type_id' => $violationType->id,
            'recorded_by' => User::factory(),
            'violation_date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'points' => $violationType->points,
            'notes' => fake()->optional(0.3)->sentence(),
        ];
    }
}