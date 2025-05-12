<?php

namespace App\Imports;

use App\Models\School;
use App\Models\FieldOfStudy;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SchoolsImport implements ToModel, WithHeadingRow, WithChunkReading
{
    // Define the chunk size (e.g., 100 rows at a time)
    public function chunkSize(): int
    {
        return 100;  // You can adjust this based on your needs
    }

    public function model(array $row)
    {
        // 1. Insert or update the school (institution) with translations
        $school = School::whereJsonContains('name->ar', $row['institution_name_arabic'])
                        ->whereJsonContains('name->en', $row['institution_name_arabic'])
                        ->first();

        if (!$school) {
            $school = new School();
            $school->name = ['ar' => $row['institution_name_arabic'], 'en' => $row['institution_name_arabic']];
            $school->description = ['ar' => $row['description_arabic'] ?? '', 'en' => $row['description_english'] ?? ''];
            $school->status = 1;
            $school->address = null; // Customize if needed
            $school->save();
        }

        // 2. Insert or update the major (Field of Study) - Check uniqueness based on Arabic and English names
        $major = FieldOfStudy::whereJsonContains('name->ar', $row['major_arabic'])
                             ->whereJsonContains('name->en', $row['major_english'])
                             ->where('parent_id', null)
                             ->first();

        if (!$major) {
            $major = new FieldOfStudy();
            $major->name = ['ar' => $row['major_arabic'], 'en' => $row['major_english']];
            $major->parent_id = null;
            $major->save();
        }

        // 3. Insert or update the minor (Field of Study under the major) - Check uniqueness based on Arabic and English names
        $minor = FieldOfStudy::whereJsonContains('name->ar', $row['minor_arabic'])
                             ->whereJsonContains('name->en', $row['minor_english'])
                             ->where('parent_id', $major->id)
                             ->first();

        if (!$minor) {
            $minor = new FieldOfStudy();
            $minor->name = ['ar' => $row['minor_arabic'], 'en' => $row['minor_english']];
            $minor->parent_id = $major->id;
            $minor->save();
        }

        return $school;
    }
}

