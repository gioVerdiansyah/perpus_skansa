<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Publisher::create([
                'name' => fake('id_ID')->unique()->company(),
                'address' => fake('id_ID')->unique()->address(),
                'email' => fake('id_ID')->unique()->safeEmail(),
                'phone' => fake('id_ID')->unique()->phoneNumber(),
                'website' => fake('id_ID')->unique()->url(),
                'logo' => "logo-publisher.png",
                'since' => fake()->year(),
                'description' => fake('id_ID')->unique()->paragraph()
            ]);
        }
    }
}