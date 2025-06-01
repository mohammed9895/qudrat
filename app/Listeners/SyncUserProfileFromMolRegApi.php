<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Country;
use App\Models\Education;
use App\Models\EducationType;
use App\Models\Experience;
use App\Models\FieldOfStudy;
use App\Models\Language;
use App\Models\Nationality;
use App\Models\Province;
use App\Models\School;
use App\Models\Skill;
use App\Models\State;
use App\Services\QudratService;
use Carbon\Carbon;

class SyncUserProfileFromMolRegApi
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event)
    {
       $user = $event->user;
        $data = $event->registrationData;
        $fallback = $event->fallbackData;

       if (! $data && $fallback) {
        // Fallback mode – QudratService returned no data
        $user->profile()->updateOrCreate(['user_id' => $user->id], [
            'fullname' => [
                'en' => $user->getTranslation('name', 'en'),
                'ar' => $user->getTranslation('name', 'ar'),
            ],
            'email' => $fallback['Contact']['Email'] ?? 'info@example.com',
            'gender' => ($fallback['GenderID'] ?? '') === 1 ? 1 : 0,
            'username' => rand(1000000000000, 99999999999999),
        ]);

        \Log::info('User profile created using fallback data for user_id: ' . $user->id);
        return;
    }

            // Skip if data is not valid
            if (! $data || !($data['issuccess'] ?? true) || strtolower($data['message'] ?? '') !== 'data retrieved successfully') {
                \Log::warning('Qudrat API returned no valid data for user_id: ' . $user->id);
                return;
            }

            $nationalityAr = $this->safeString($data['NATIONALITY_DESC_ARB'] ?? '');
            $regionAr = $this->safeString($data['PER_REGION_desc'] ?? '');
            $wilayatAr = $this->safeString($data['PER_WILAYAT_DESC_ARB'] ?? '');
            $residenceWilayatAr = $this->safeString($data['RES_WILAYAT_DESC_ARB'] ?? '');

            // Country
            $country = ! empty($nationalityAr)
                ? Country::where('name->ar', $nationalityAr)->first()
                    ?: Country::create(['name' => ['ar' => $nationalityAr, 'en' => $nationalityAr]])
                : null;

            // Province
            $province = ! empty($regionAr)
                ? Province::where('name->ar', $regionAr)->first()
                    ?: Province::create(['name' => ['ar' => $regionAr, 'en' => $regionAr]])
                : null;


            // State
            $state = ! empty($wilayatAr)
                ? State::where('name->ar', $wilayatAr)->first()
                    ?: State::create(['name' => ['ar' => $wilayatAr, 'en' => $wilayatAr], 'province_id' => $province->id])
                : null;

            // Residence State
            $residenceState = ! empty($residenceWilayatAr)
                ? State::where('name->ar', $residenceWilayatAr)->first()
                    ?: State::create(['name' => ['ar' => $residenceWilayatAr, 'en' => $residenceWilayatAr], 'province_id' => $province->id])
                : null;

            $nationality = ! empty($nationalityAr)
            ? Nationality::where('name->ar', $nationalityAr)->first()
                ?: Nationality::create(['name' => ['ar' => $nationalityAr, 'en' => $nationalityAr]])
            : null;

            $profile = $user->profile()->updateOrCreate(['user_id' => $user->id], [
                'fullname' => [
                    'en' => $user->getTranslation('name', 'en'),  // Get 'fullname' in English
                    'ar' => $user->getTranslation('name', 'ar'),
                ],
                'email' => $this->safeString($data['EMAIL_ADDRESS'] ?? null),
                'phone' => $this->safeString($data['TELNO1'] ?? null),
                'position' => $this->safeString($data['DESIGNATION_DESC'] ?? null),
                'gender' => ($data['SEX'] ?? '') === 'M' ? 1 : 0,
                'username' => rand(1000000000000, 99999999999999),
                'dob' => isset($data['DATE_OF_BIRTH']) && is_string($data['DATE_OF_BIRTH'])
                    ? \Carbon\Carbon::parse($data['DATE_OF_BIRTH'])->format('Y-m-d')
                    : null,
                'country_id' => optional($country)->id,
                'nationality_id' => optional($nationality)->id,
                'province_id' => optional($province)->id,
                'state_id' => optional($state)->id,
                'permanent_residence_state_id' => optional($residenceState)->id,
                'health_status' => $this->safeString($data['HEALTH_STATUS'] ?? null),
                'education_type_id' => optional(
                    EducationType::where('name->ar', 'like', '%'.$this->safeString($data['EDUCATION_DESC_ARB'] ?? '').'%')->first()
                )->id,
                'company' => $this->safeString($data['SPONSOR_NAME'] ?? null),
            ]);

            // Normalize data
            $educationList = $data['ListOfEducation']['TRANEDUCATIONDet'] ?? [];

            if (isset($educationList['EDUCATION_ID'])) {
                $educationList = [$educationList]; // handle single record
            }

            foreach ($educationList as $item) {

                if (! is_array($item)) {
                    continue;
                }

                // Arabic names
                $schoolNameAr = $this->safeString($item['NIMR_MOHE_UNIVERSITY_DESC'] ?? null);
                $educationTypeNameAr = $this->safeString($item['EDUCATION_DESC_ARB'] ?? null);
                $majorNameAr = $this->safeString($item['NIMR_MOHE_MAJOR_QLFN_DESC'] ?? null);
                $minorNameAr = $this->safeString($item['NIMR_MOHE_MINOR_QLFN_DESC'] ?? null);

                if (! $schoolNameAr && ! $educationTypeNameAr && ! $majorNameAr && ! $minorNameAr) {
                    continue;
                }

                // Related models
                $school = $schoolNameAr
                    ? School::firstOrCreate(['name->ar' => $schoolNameAr], ['name' => ['ar' => $schoolNameAr, 'en' => $schoolNameAr]])
                    : null;

                $educationType = $educationTypeNameAr
                    ? EducationType::firstOrCreate(['name->ar' => $educationTypeNameAr], ['name' => ['ar' => $educationTypeNameAr, 'en' => $educationTypeNameAr]])
                    : null;

                $fieldOfStudy = $majorNameAr
                    ? FieldOfStudy::firstOrCreate(['name->ar' => $majorNameAr], ['name' => ['ar' => $majorNameAr, 'en' => $majorNameAr]])
                    : null;

                $childFieldOfStudy = $minorNameAr
                    ? FieldOfStudy::firstOrCreate(['name->ar' => $minorNameAr], ['name' => ['ar' => $minorNameAr, 'en' => $minorNameAr]])
                    : null;

                // Parse date
                $endDate = is_string($item['GRADUATION_DATE']) && strlen($item['GRADUATION_DATE']) === 4
                    ? Carbon::createFromDate($item['GRADUATION_DATE'], 6, 1)
                    : null;

                // Duplicate check
                $alreadyExists = Education::where('profile_id', $profile->id)
                    ->where('school_id', $school?->id)
                    ->where('education_type_id', $educationType?->id)
                    ->where('field_of_study_id', $fieldOfStudy?->id)
                    ->where('field_of_study_child_id', $childFieldOfStudy?->id)
                    ->whereDate('end_date', $endDate)
                    ->exists();

                if ($alreadyExists) {
                    continue;
                }

                // Create education
                Education::create([
                    'profile_id' => $profile->id,
                    'school_id' => $school?->id,
                    'education_type_id' => $educationType?->id,
                    'field_of_study_id' => $fieldOfStudy?->id,
                    'field_of_study_child_id' => $childFieldOfStudy?->id,
                    'grade' => $this->safeString($item['NMR_GRADES_DESC_ARB'] ?? null),
                    'start_date' => null,
                    'end_date' => $endDate,
                    'graduated' => ($item['LEGEL_FLAG'] ?? '') === 'Y',
                    'addable_type' => \App\Models\User::class,
                    'addable_id' => 1,
                ]);
            }

            // Normalize list
            $experienceList = $data['listOfExp']['EXPDETAILS'] ?? [];

            if (isset($experienceList['CrNo'])) {
                $experienceList = [$experienceList]; // wrap single entry
            }

            foreach ($experienceList as $exp) {
                if (! is_array($exp)) {
                    continue;
                }

                $company = $this->safeString($exp['SponsorName'] ?? null);
                $position = $this->safeString($exp['OccupDesc'] ?? null);
                $startDate = $this->safeDate($exp['StartDate'] ?? null);
                $endDate = $this->safeDate($exp['EndDate'] ?? null);

                if (! $company && ! $startDate) {
                    continue;
                }

                $isCurrent = $endDate === null;

                // ✅ Duplicate check
                $alreadyExists = Experience::where('profile_id', $user->profile->id)
                    ->where('company', $company)
                    ->where('position', $position)
                    ->whereDate('start_date', $startDate)
                    ->whereDate('end_date', $endDate)
                    ->exists();

                if ($alreadyExists) {
                    continue; // skip duplicate
                }

                // ✅ Insert
                Experience::create([
                    'profile_id' => $user->profile->id,
                    'company' => $company,
                    'position' => $position,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'is_current' => $isCurrent,
                    'description' => null,
                    'sort' => 1,
                    'addable_type' => \App\Models\User::class,
                    'addable_id' => 1,
                ]);
            }

            // Normalize
            $langList = $data['listOfLang']['LANGUAGEDet'] ?? [];

            if (isset($langList['LANGUAGE_DESC_ARB'])) {
                $langList = [$langList];
            }

            foreach ($langList as $item) {
                if (! is_array($item)) {
                    continue;
                }

                $langNameAr = $this->safeString($item['LANGUAGE_DESC_ARB'] ?? null);
                $langNameEn = $this->safeString($item['LANGUAGE_DESC_ENG'] ?? $langNameAr);

                if (! $langNameAr) {
                    continue;
                }

                // ✅ Find or create language by Arabic name
                $language = Language::where('name->ar', $langNameAr)->first();

                if (! $language) {
                    $language = Language::create([
                        'name' => ['ar' => $langNameAr, 'en' => $langNameEn],
                        'code' => uniqid('lang_'),
                    ]);
                }

                // ✅ Prevent duplicate pivot entries
                $alreadyLinked = $profile->languages()->where('language_id', $language->id)->exists();

                if (! $alreadyLinked) {
                    $profile->languages()->attach($language->id);
                }
            }

            // Normalize the skill input
            $skillsList = $data['listOfSKILLDet']['SKILLDet'] ?? [];

            if (isset($skillsList['SKILLNAME'])) {
                $skillsList = [$skillsList]; // handle single skill
            }

            foreach ($skillsList as $item) {
                if (! is_array($item)) {
                    continue;
                }

                $skillNameAr = $this->safeString($item['SKILLNAME'] ?? null);
                $skillNameEn = $this->safeString($item['SKILLNAME_ENG'] ?? $skillNameAr);
                $skillTypeDescAr = $this->safeString($item['SKILLTYPE_DESC'] ?? null);
                $skillTypeDescEn = $this->safeString($item['SKILLTYPE_DESC_ENG'] ?? $skillTypeDescAr);

                if (! $skillNameAr) {
                    continue;
                }

                // ✅ Find or create by Arabic name
                $skill = Skill::where('name->ar', $skillNameAr)->first();

                if (! $skill) {
                    $skill = Skill::create([
                        'name' => ['ar' => $skillNameAr, 'en' => $skillNameEn],
                        'description' => ['ar' => $skillTypeDescAr, 'en' => $skillTypeDescEn],
                        'status' => 1,
                    ]);
                }

                // ✅ Prevent duplicate in pivot
                $alreadyLinked = $profile->skills()->where('skill_id', $skill->id)->exists();

                if (! $alreadyLinked) {
                    $profile->skills()->attach($skill->id);
                }
            }

            $licenseList = $data['LicenDet']['LICENSEDETAILSDet'] ?? [];

            if (isset($licenseList['LICENSE_TYPE'])) {
                $licenseList = [$licenseList];
            }

            foreach ($licenseList as $item) {
                if (! is_array($item)) {
                    continue;
                }

                $typeAr = $this->safeString($item['LICENSE_DESC_ARB'] ?? null);
                $typeEn = $this->safeString($item['LICENSE_DESC_ENG'] ?? $typeAr);

                $issuePlaceAr = $this->safeString($item['LICENSE_ISSUE_PLACE_DESC_ARB'] ?? null);
                $issuePlaceEn = $this->safeString($item['LICENSE_ISSUE_PLACE_DESC_ENG'] ?? $issuePlaceAr);

                $issueDate = ! empty($item['LICENSE_ISSUE_DATE']) ? Carbon::parse($item['LICENSE_ISSUE_DATE'])->format('Y-m-d') : null;
                $expireDate = ! empty($item['LICENSE_EXPIRE_DATE']) ? Carbon::parse($item['LICENSE_EXPIRE_DATE'])->format('Y-m-d') : null;

                if (! $typeAr && ! $issueDate && ! $expireDate) {
                    continue;
                }

                // Check if license with same Arabic name already exists for this profile
                $existing = $profile->licenses()
                    ->where('type->ar', $typeAr)
                    ->whereDate('issue_date', $issueDate)
                    ->whereDate('expire_date', $expireDate)
                    ->first();

                if (! $existing) {
                    $profile->licenses()->create([
                        'type' => ['ar' => $typeAr, 'en' => $typeEn],
                        'issue_place' => ['ar' => $issuePlaceAr, 'en' => $issuePlaceEn],
                        'issue_date' => $issueDate,
                        'expire_date' => $expireDate,
                    ]);
                }
            }

            $trainingList = $data['listOfTrain']['VOCTRAINGDet'] ?? [];

            if (isset($trainingList['TRAINING_COURSE_DESC_ARB'])) {
                $trainingList = [$trainingList];
            }

            foreach ($trainingList as $item) {
                if (! is_array($item)) {
                    continue;
                }

                $courseNameAr = $this->safeString($item['TRAINING_COURSE_DESC_ARB'] ?? null);
                $courseNameEn = $this->safeString($item['TRAINING_COURSE_DESC_ENG'] ?? $courseNameAr);

                $countryAr = $this->safeString($item['TRAINING_COUNTRY_DESC_ARB'] ?? null);
                $countryEn = $this->safeString($item['TRAINING_COUNTRY_DESC_ENG'] ?? $countryAr);

                $typeAr = $this->safeString($item['TRAINING_TYPE_DESC_ARB'] ?? null);
                $typeEn = $this->safeString($item['TRAINING_TYPE_DESC_ENG'] ?? $typeAr);

                $duration = is_numeric($item['TRAINING_DURATION'] ?? null) ? (int) $item['TRAINING_DURATION'] : null;

                $startDate = ! empty($item['TRAINING_FROM']) ? Carbon::parse($item['TRAINING_FROM'])->format('Y-m-d') : null;
                $endDate = ! empty($item['TRAINING_TO']) ? Carbon::parse($item['TRAINING_TO'])->format('Y-m-d') : null;

                if (! $courseNameAr) {
                    continue;
                }

                // Avoid duplicates: match on course name, dates, and duration
                $exists = $profile->trainings()
                    ->where('course_name->ar', $courseNameAr)
                    ->whereDate('start_date', $startDate)
                    ->whereDate('end_date', $endDate)
                    ->where('duration', $duration)
                    ->first();

                if (! $exists) {
                    $profile->trainings()->create([
                        'course_name' => ['ar' => $courseNameAr, 'en' => $courseNameEn],
                        'country' => ['ar' => $countryAr, 'en' => $countryEn],
                        'type' => ['ar' => $typeAr, 'en' => $typeEn],
                        'duration' => $duration,
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                    ]);
                }
            }
        

    }

    public function safeString($value)
    {
        return is_string($value) ? trim($value) : null;
    }

    /**
     * Helper to safely parse a date
     */
    public function safeDate($value)
    {
        return is_string($value) && ! empty($value)
            ? Carbon::parse($value)->format('Y-m-d')
            : null;
    }
}
