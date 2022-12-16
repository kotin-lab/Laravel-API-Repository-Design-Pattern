<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'title' => $this->faker->title(),
          'content' => $this->faker->paragraph(5),
          'cat_id' => rand(1, 5),
          'user_id' => rand(1, 11),
        ];
    }
}
