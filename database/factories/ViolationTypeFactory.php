<?php

namespace Database\Factories;

use App\Models\ViolationCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ViolationType>
 */
class ViolationTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $violationTypes = [
            'Terlambat' => 5,
            'Tidak Memakai Atribut Lengkap' => 10,
            'Tidak Mengerjakan Tugas' => 15,
            'Berkelahi' => 50,
            'Merokok' => 25,
            'Tidak Masuk Tanpa Keterangan' => 20,
            'Berpakaian Tidak Rapi' => 5,
            'Tidur di Kelas' => 10,
            'Menggunakan HP di Kelas' => 15,
            'Tidak Hormat kepada Guru' => 30,
        ];
        
        $type = fake()->randomElement(array_keys($violationTypes));
        $points = $violationTypes[$type];
        
        return [
            'violation_category_id' => ViolationCategory::factory(),
            'name' => $type,
            'description' => fake()->sentence(),
            'points' => $points,
            'status' => 'active',
        ];
    }

    /**
     * Indicate that the type is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the type is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'inactive',
        ]);
    }
}