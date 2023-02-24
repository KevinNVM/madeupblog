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
            'role' => 'admin'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Darmawan',
            'username' => '@darmawan',
            'email' => 'darmawan021@gmail.com',
            'password' => bcrypt('password'),
        ]);

        Category::create([
            'name' => "Uncategorized",
        ]);
        Category::create([
            'name' => "Technology",
        ]);
        Category::create([
            'name' => "News",
        ]);
        Category::create([
            'name' => "Slife of Life",
        ]);
        Category::create([
            'name' => "World",
        ]);
        Category::create([
            'name' => "Web",
        ]);
        Category::create([
            'name' => "Web Developer",
        ]);
        Category::create([
            'name' => "Programming",
        ]);
        Category::create([
            'name' => "Personal",
        ]);
        Category::create([
            'name' => "Blog",
        ]);


        Post::factory(50)->create();
    }
}
