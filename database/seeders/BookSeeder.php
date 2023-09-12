<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    protected $daftarBuku = [
        "Laskar Pelangi",
        "Bumi Manusia",
        "Ayat-Ayat Cinta",
        "Perahu Kertas",
        "Dilan: Dia Adalah Dilanku Tahun 1990",
        "Tenggelamnya Kapal Van Der Wijck",
        "Negeri 5 Menara",
        "Ketika Cinta Bertasbih",
        "5 cm",
        "Garis Waktu"
    ];
    public function run(): void
    {
        Book::create([
            'isbn' => fake()->unique()->isbn13(),
            'title' => fake()->unique()->randomElement($this->daftarBuku),
            'thumbnail' => "thumbnail-book.png",
            'description' => fake('id_ID')->paragraph(),
            'category_id' => 1,
            'author_id' => 1,
            'publisher_id' => 1,
        ]);
        Book::create([
            'isbn' => fake()->unique()->isbn13(),
            'title' => fake()->unique()->randomElement($this->daftarBuku),
            'thumbnail' => "thumbnail-book.png",
            'description' => fake('id_ID')->paragraph(),
            'category_id' => 2,
            'author_id' => 2,
            'publisher_id' => 2,
        ]);
        Book::create([
            'isbn' => fake()->unique()->isbn13(),
            'title' => fake()->unique()->randomElement($this->daftarBuku),
            'thumbnail' => "thumbnail-book.png",
            'description' => fake('id_ID')->paragraph(),
            'category_id' => 3,
            'author_id' => 3,
            'publisher_id' => 3,
        ]);
        Book::create([
            'isbn' => fake()->unique()->isbn13(),
            'title' => fake()->unique()->randomElement($this->daftarBuku),
            'thumbnail' => "thumbnail-book.png",
            'description' => fake('id_ID')->paragraph(),
            'category_id' => 4,
            'author_id' => 4,
            'publisher_id' => 4,
        ]);
        Book::create([
            'isbn' => fake()->unique()->isbn13(),
            'title' => fake()->unique()->randomElement($this->daftarBuku),
            'thumbnail' => "thumbnail-book.png",
            'description' => fake('id_ID')->paragraph(),
            'category_id' => 5,
            'author_id' => 5,
            'publisher_id' => 5,
        ]);
    }
}