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
            'user_id' => mt_rand(1, 2),
            'title' => $title,
            'slug' => mt_rand(10e4, 10e6) . '-' . str()->slug($title),
            'body' => $this->faker->paragraphs(50, true),
            'category_id' => mt_rand(1, 2)
        ];
    }
}
