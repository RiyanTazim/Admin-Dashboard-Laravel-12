<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         if (\App\Models\SocialMedia::exists()) {
            $this->command->info('Social media already seeded. No new data inserted.');
            return;
        }

        $socialMedias = [
            [
                'name' => 'Facebook',
                'url' => 'https://www.facebook.com/',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Instagram',
                'url' => 'https://www.instagram.com/',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Twitter',
                'url' => 'https://www.twitter.com/',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'LinkedIn',
                'url' => 'https://www.linkedin.com/',
                'image' => null,
                'status' => 'active',
            ],
        ];

        foreach ($socialMedias as $socialMedia) {
            \App\Models\SocialMedia::create($socialMedia);
        }
    }
}
