<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $educationTypes = [
            ['en' => 'Primary', 'ar' => 'ابتدائي'],
            ['en' => 'Middle', 'ar' => 'متوسط'],
            ['en' => 'Secondary', 'ar' => 'ثانوي'],
            ['en' => 'Diploma', 'ar' => 'دبلوم'],
            ['en' => 'Bachelor', 'ar' => 'بكالوريوس'],
            ['en' => 'Master', 'ar' => 'ماجستير'],
            ['en' => 'Doctorate', 'ar' => 'دكتوراه'],
        ];

        foreach ($educationTypes as $educationType) {
            DB::table('education_types')->insert([
                'name' => json_encode(['en' => $educationType['en'], 'ar' => $educationType['ar']]),
            ]);
        }
    }
}
