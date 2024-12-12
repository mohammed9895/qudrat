<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'IT',
                'description' => 'Information Technology',
                'status' => 1,
            ],
            [
                'name' => 'HR',
                'description' => 'Human Resources',
                'status' => 1,
            ],
            [
                'name' => 'Finance',
                'description' => 'Finance Department',
                'status' => 1,
            ],
            [
                'name' => 'Marketing',
                'description' => 'Marketing Department',
                'status' => 1,
            ],
            [
                'name' => 'Sales',
                'description' => 'Sales Department',
                'status' => 1,
            ],
        ];

        foreach ($departments as $department) {
            \App\Models\JobDepartment::create($department);
        }
    }
}
