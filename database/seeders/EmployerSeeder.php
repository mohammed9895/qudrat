<?php

namespace Database\Seeders;

use App\Enums\EmployerCategory;
use App\Models\Employer;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => ['ar' => 'مؤسسات القطاع الحكومي', 'en' => 'Government Sector Institutions'],
                'category' => EmployerCategory::GovernmentInstitutions,
                'sort' => 1,
            ],
            [
                'name' => ['ar' => 'الشركات الحكومية', 'en' => 'Government Companies'],
                'category' => EmployerCategory::GovernmentCompanies,
                'sort' => 2,
            ],
            [
                'name' => ['ar' => 'مؤسسات القطاع الخاص', 'en' => 'Private Sector Institutions'],
                'category' => EmployerCategory::PrivateSector,
                'sort' => 3,
            ],
            [
                'name' => ['ar' => 'ريادة الأعمال', 'en' => 'Entrepreneurship'],
                'category' => EmployerCategory::Entrepreneurship,
                'sort' => 4,
            ],
            [
                'name' => ['ar' => 'باحثين عن عمل', 'en' => 'Job Seekers'],
                'category' => EmployerCategory::JobSeekers,
                'sort' => 5,
            ],
        ];

        foreach ($data as $item) {
            Employer::create($item);
        }
    }
}
