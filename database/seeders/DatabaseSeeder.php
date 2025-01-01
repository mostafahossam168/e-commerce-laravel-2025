<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '01064564850',
            'type' => 'admin',
            'password' => bcrypt('123456'),
        ]);
        $this->call([
            CategorySeeder::class,
            SettingSeeder::class,
        ]);
    }
}
