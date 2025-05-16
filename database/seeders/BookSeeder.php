<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Untuk data Indonesia
        
        $categories = ['Novel', 'Pendidikan', 'Agama', 'Sains', 'Sejarah', 'Teknologi'];
        $publishers = ['Gramedia', 'Erlangga', 'Mizan', 'Kompas', 'Republika', 'Andi Publisher'];
        
        for ($i = 0; $i < 50; $i++) {
            Book::create([
                'title' => $this->generateBookTitle($faker, $categories[array_rand($categories)]),
                'author' => $faker->name,
                'publisher' => $publishers[array_rand($publishers)],
                'year' => $faker->numberBetween(2000, 2023),
                'isbn' => $faker->unique()->isbn13,
                'stock' => $faker->numberBetween(1, 100), // Minimal 1
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
    
    private function generateBookTitle($faker, $category)
    {
        $prefixes = [
            'Novel' => ['Petualangan', 'Cinta', 'Misteri', 'Fantasi', 'Sejarah'],
            'Pendidikan' => ['Panduan', 'Dasar', 'Lengkap', 'Teori', 'Praktikum'],
            'Agama' => ['Rahasia', 'Hikmah', 'Panduan', 'Kajian', 'Tuntunan'],
            'Sains' => ['Eksperimen', 'Penemuan', 'Konsep', 'Prinsip', 'Aplikasi'],
            'Sejarah' => ['Peradaban', 'Kerajaan', 'Perjuangan', 'Tokoh', 'Peristiwa'],
            'Teknologi' => ['Pemrograman', 'Jaringan', 'Kecerdasan', 'Data', 'Sistem']
        ];
        
        $suffixes = [
            'yang Menginspirasi',
            'untuk Pemula',
            'Modern',
            'Kontemporer',
            'Edisi Terbaru',
            'Lengkap'
        ];
        
        $prefix = $prefixes[$category][array_rand($prefixes[$category])];
        $main = $faker->words(2, true);
        $suffix = $suffixes[array_rand($suffixes)];
        
        return "$prefix $main $suffix";
    }
}