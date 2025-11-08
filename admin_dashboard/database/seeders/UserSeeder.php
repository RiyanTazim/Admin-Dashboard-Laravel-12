<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminExists = User::where('id', 1)->exists();
        $userExists  = User::where('id', 2)->exists();

        if (! $adminExists) {
            User::updateOrCreate([
                'id'                => 1,
                'name'              => 'Mr. Admin',
                'username'          => 'admin',
                'email'             => 'admin@admin.com',
                'is_admin'          => true,
                'password'          => bcrypt('12345678'),
                'email_verified_at' => now(),
            ]);
        }

        if (! $userExists) {
            User::updateOrCreate([
                'id'                => 2,
                'name'              => 'Mr. User',
                'username'          => 'user',
                'email'             => 'user@user.com',
                'is_admin'          => false,
                'password'          => bcrypt('12345678'),
                'email_verified_at' => now(),
            ]);
        }

        if ($adminExists && $userExists) {
            $this->command->info('User/Admin already exist.');
        }
    }
}
