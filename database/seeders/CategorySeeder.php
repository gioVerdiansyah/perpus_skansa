<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected $kategori = [
        "Fiksi",
        "Non-Fiksi",
        "Kesehatan",
        "Sejarah",
        "Pendidikan"
    ];
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Category::create([
                'name' => fake()->unique()->randomElement($this->kategori)
            ]);
        }
    }
}