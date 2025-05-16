<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

<<<<<<< HEAD
=======

>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
<<<<<<< HEAD
    public function run(): void
    {
        $this->call([
        BookSeeder::class,
        MemberSeeder::class,
    ]);
    }
}
=======
    public function run()
    {
        $this->call([
            BookSeeder::class,
            MemberSeeder::class,
        ]);
    }

}

>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
