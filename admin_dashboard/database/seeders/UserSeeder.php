<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add admin
        $admin = \App\Models\User::where('email', 'admin@admin.com')->first();
        if (! $admin) {
            \App\Models\User::create([
                'name'              => 'Mr. Admin',
                'email'             => 'admin@admin.com',
                'role'              => 'admin',
                'is_premium'        => false,
                'password'          => bcrypt('12345678'),
                'email_verified_at' => now(),
            ]);
        } else {
            $this->command->info('Admin already exists in database');
        }

        // Add regular user
        $user = \App\Models\User::where('email', 'user@user.com')->first();
        if (! $user) {
            \App\Models\User::create([
                'name'              => 'Mr. User',
                'email'             => 'user@user.com',
                'role'              => 'user',
                'is_premium'        => true,
                'password'          => bcrypt('12345678'),
                'email_verified_at' => now(),
            ]);
        } else {
            $this->command->info('User already exists in database');
        }
    }
}
