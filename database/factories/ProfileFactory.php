<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
            'fullname' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'avatar' => $this->faker->imageUrl(),
            'position' => $this->faker->word,
            'bio' => $this->faker->sentence,
            'gender' => $this->faker->randomDigit(0, 1),
            'dob' => $this->faker->date(),
            'cv' => $this->faker->url,
            'video' => $this->faker->url,
            'experience_level_id' => rand(1, 10),
            'address' => $this->faker->address,
            'status' => 1,
        ];
    }
}
