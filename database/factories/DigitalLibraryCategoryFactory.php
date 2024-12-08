<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DigitalLibraryCategory>
 */
class DigitalLibraryCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name  = $this->faker->realText(20),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->boolean(),
            'parent_id' => null,
        ];
    }
}
