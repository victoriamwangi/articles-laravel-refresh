<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Article;


class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'user_id' => User::all()->random()->id,
            'post_id' => Article::all()->random()->id,
            'comment' => $this->faker->paragraph(),


        ];
    }
}
