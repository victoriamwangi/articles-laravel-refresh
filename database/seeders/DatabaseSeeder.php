<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Comment;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(6)->create();
        Article::factory(10)->create();
        Comment::factory(10)->create();
    }
}
