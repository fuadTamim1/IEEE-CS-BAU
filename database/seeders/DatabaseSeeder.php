<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder as SeedersRolesAndPermissionsSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        
        $this->call(RolesSeeder::class);
        $this->call(SeedersRolesAndPermissionsSeeder::class);
        $admin = User::firstOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password'), // Change this later!
        ]);

        // Assign admin role
        $admin->assignRole('admin');

        $this->call(SettingsSeeder::class);
        $this->call(TextConfigSeeder::class);
    }
}
