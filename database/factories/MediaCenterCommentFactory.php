<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MediaCenterComment>
 */
class MediaCenterCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'media_center_post_id' => \App\Models\MediaCenterPost::factory(),
            'user_id' => \App\Models\User::factory(),
            'content' => $this->faker->paragraph,
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
