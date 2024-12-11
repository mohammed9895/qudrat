<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $disabilities = [
            ['en' => 'None', 'ar' => 'لا يوجد'],
            ['en' => 'Mobility', 'ar' => 'إعاقة حركية'],
            ['en' => 'Ocular', 'ar' => 'إعاقة بصرية'],
            ['en' => 'Auricular', 'ar' => 'إعاقة سمعية'],
        ];

        foreach ($disabilities as $disability) {
            DB::table('disabilities')->insert([
                'name' => json_encode(['en' => $disability['en'], 'ar' => $disability['ar']]),
            ]);
        }

    }
}
