<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // Create user John Doe
      User::create([
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'email_verified_at' => now(),
        'password' => bcrypt('johndoe@example.com'), // johndoe@example.com
        'remember_token' => Str::random(10),
      ]);

      // Create 10 users
      User::factory(10)->create();

      // Create 5 categories
      Category::factory()
        ->count(5)
        ->create();

      // Create 10 articles
      Article::factory()
        ->count(50)
        ->create();
    }
}
