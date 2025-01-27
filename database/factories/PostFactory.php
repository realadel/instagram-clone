<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = ['post1.jpg', 'post2.jpeg', 'post3.jpg'];
        return [
            'user_id' => User::factory(),
            'image' => 'posts/' . fake()->randomElement($images),

            'description' => fake()->sentence(40),
            'slug' => fake()->regexify('[A-Za-z0-9]{10}')
        ];
    }
}
