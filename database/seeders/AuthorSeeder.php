<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 7; $i++) {
            Author::create([
                'name' => fake('id_ID')->firstName() . " " . fake('id_ID')->lastName(),
                'email' => fake('id_ID')->unique()->safeEmail(),
                'address' => fake('id_ID')->unique()->address(),
            ]);
        }
    }
}