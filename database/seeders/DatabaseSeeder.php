<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PenugasanPasar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('123'),
            'role' => 'admin'
        ]);

        $this->call([
            UserSeeder::class,
            PasarSeeder::class,
            TokoSeeder::class,
            PenugasanPasarSeeder::class,
            KomoditasSeeder::class,
        ]);
    }
}
