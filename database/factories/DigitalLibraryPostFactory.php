<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DigitalLibraryPost>
 */
class DigitalLibraryPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->realText(20),
            'slug' => \Str::slug($title),
            'description' => $this->faker->text(),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->boolean(),
            'is_featured' => $this->faker->boolean(),
            'author_id' => \App\Models\User::factory(),
            'digital_library_category_id' => \App\Models\DigitalLibraryCategory::factory(),
        ];
    }
}
