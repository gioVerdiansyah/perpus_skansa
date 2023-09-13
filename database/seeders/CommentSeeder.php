<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Comment::create([
                'user_id' => 1,
                'book_id' => 1,
                'comment_value' => fake()->text(50),
                'rating' => fake()->numberBetween(1, 5)
            ]);
        }
    }
}