<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 👇 Voeg deze regel toe om je energy data seeder te draaien
        $this->call(EnergyDataSeeder::class);
    }
}
