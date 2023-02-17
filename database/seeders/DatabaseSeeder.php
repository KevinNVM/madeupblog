<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\Post\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Kevin',
            'username' => '@kevin',
            'email' => 'kevindarmawan022@gmail.com',
            'password' => bcrypt('password'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Darmawan',
            'username' => '@darmawan',
            'email' => 'darmawan021@gmail.com',
            'password' => bcrypt('password'),
        ]);

        Category::create([
            'name' => "General",
        ]);
        Category::create([
            'name' => "Lifestyle",
        ]);

        Post::factory(300)->create();

        foreach (range(1, 200) as $element) {
            Category::create([
                'name' => str()->random()
            ]);
        }
    }
}