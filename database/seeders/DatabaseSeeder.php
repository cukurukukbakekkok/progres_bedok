<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder bawaan (biarkan saja)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Tambahkan seeder custom milikmu
        $this->call([
            UserSeeder::class,
            JurusanSeeder::class,
            KelasSeeder::class,
        ]);
    }
}
