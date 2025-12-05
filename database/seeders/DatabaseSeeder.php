<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa.id',
            'password' => bcrypt('password123'), // Ganti password ini setelah login pertama!
        ]);

        // Run pengaturan seeder
        $this->call([
            PengaturanSeeder::class,
        ]);
    }
}
