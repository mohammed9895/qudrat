<?php

namespace Database\Factories;

use App\Models\DigitalLibraryPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DigitalLibraryPostComment>
 */
class DigitalLibraryPostCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'digital_library_post_id' => DigitalLibraryPost::factory(),
            'user_id' => User::factory(),
            'content' => $this->faker->sentence,
            'status' => $this->faker->boolean(),
        ];
    }
}
