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
        // Creating a Super Admin user
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'), // Use a secure password hash in a real application
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        // Creating an Admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Use a secure password hash in a real application
            'role' => User::ROLE_ADMIN,
        ]);

        // Creating a regular User
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'), // Use a secure password hash in a real application
            'role' => User::ROLE_USER,
        ]);

        // Optionally, create additional users with the factory
        User::factory(10)->create();
    }
}
