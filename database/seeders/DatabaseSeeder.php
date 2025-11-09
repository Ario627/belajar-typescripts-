<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * Method utama untuk seeding database.
     * Dipanggil saat menjalankan: php artisan db:seed
     */
    public function run(): void
    {
        // Panggil ProjectSeeder untuk create sample data
        // ProjectSeeder akan create admin user dan sample projects
        $this->call([
            ProjectSeeder::class,
        ]);
        
        $this->command->info('Database seeded successfully!');
    }
}
