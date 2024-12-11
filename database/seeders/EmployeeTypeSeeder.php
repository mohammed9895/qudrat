<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeeTypes = [
            ['en' => 'Full Time', 'ar' => 'دوام كامل'],
            ['en' => 'Part Time', 'ar' => 'دوام جزئي'],
            ['en' => 'Freelance', 'ar' => 'حر'],
            ['en' => 'Internship', 'ar' => 'تدريب'],
        ];

        foreach ($employeeTypes as $employeeType) {
            DB::table('employee_types')->insert([
                'name' => json_encode(['en' => $employeeType['en'], 'ar' => $employeeType['ar']]),
            ]);
        }
    }
}
