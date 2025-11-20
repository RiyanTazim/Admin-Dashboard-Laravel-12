<?php

namespace Database\Seeders;

use App\Models\FAQ;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (
            FAQ::where('question', 'What is the best way to contact us?')->exists() ||
            FAQ::where('question', 'What is the best way to reset my password?')->exists()
        ) {
            $this->command->info('FAQ already seeded. No new data inserted.');
            return;
        }

        FAQ::insert([
            [
                'question' => 'What is the best way to contact us?',
                'answer' => 'You can contact us by email.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'What is the best way to reset my password?',
                'answer' => 'You can reset your password by clicking on the "Forgot Password" link on the login page.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
