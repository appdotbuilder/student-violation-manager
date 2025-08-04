<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ViolationCategory>
 */
class ViolationCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            ['name' => 'Disiplin', 'description' => 'Pelanggaran terkait kedisiplinan siswa'],
            ['name' => 'Seragam', 'description' => 'Pelanggaran terkait kelengkapan seragam'],
            ['name' => 'Akademik', 'description' => 'Pelanggaran terkait kegiatan belajar mengajar'],
            ['name' => 'Ketertiban', 'description' => 'Pelanggaran terkait ketertiban di sekolah'],
            ['name' => 'Sopan Santun', 'description' => 'Pelanggaran terkait etika dan sopan santun'],
        ];
        
        $category = fake()->randomElement($categories);
        
        return [
            'name' => $category['name'],
            'description' => $category['description'],
            'status' => 'active',
        ];
    }

    /**
     * Indicate that the category is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the category is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'inactive',
        ]);
    }
}