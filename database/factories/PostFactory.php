<?php

namespace Database\Factories;

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
    public function definition()
    {
        $title = $this->faker->words(mt_rand(1, 5), true);
        return [
            'user_id' => 1,
            'title' => $title,
            'slug' => str($title)->slug(),
            'body' => $this->faker->paragraphs(50, true)
        ];
    }
}
