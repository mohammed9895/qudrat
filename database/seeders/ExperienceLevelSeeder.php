<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experienceLevels = [
            ['en' => '1 Year <', 'ar' => 'اقل من سنة'],
            ['en' => '1-2 Years', 'ar' => '1-2 سنة'],
            ['en' => '2-3 Years', 'ar' => '2-3 سنة'],
            ['en' => '3-5 Years', 'ar' => '3-5 سنة'],
            ['en' => '5-7 Years', 'ar' => '5-7 سنة'],
            ['en' => '7-10 Years', 'ar' => '7-10 سنة'],
            ['en' => '10-15 Years', 'ar' => '10-15 سنة'],
            ['en' => '15-20 Years', 'ar' => '15-20 سنة'],
            ['en' => '20-25 Years', 'ar' => '20-25 سنة'],
            ['en' => '25-30 Years', 'ar' => '25-30 سنة'],
            ['en' => '30 Years >', 'ar' => 'اكثر من 30 سنة'],
        ];

        foreach ($experienceLevels as $experienceLevel) {
            DB::table('experience_levels')->insert([
                'name' => json_encode(['en' => $experienceLevel['en'], 'ar' => $experienceLevel['ar']]),
            ]);
        }
    }
}
