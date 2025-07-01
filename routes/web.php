<?php

use App\Http\Controllers\AuthController;
use App\Imports\SchoolsImport;
use App\Livewire\Auth\LoginCallback;
use App\Livewire\Frontend\DigitalLibrary\ListPosts;
use App\Livewire\Frontend\Home\GlobalSearch;
use App\Livewire\Frontend\Innovators;
use App\Livewire\Frontend\MediaCenter\Post;
use App\Livewire\Frontend\Researchers;
use App\Livewire\Frontend\SocialWindow\Category;
use App\Livewire\Frontend\SocialWindow\Experts;
use App\Livewire\Frontend\SocialWindow\Skill;
use App\Livewire\Frontend\SocialWindow\Tool;
use App\Livewire\Frontend\Work\Index;
use App\Livewire\Frontend\Work\Show;
use App\Livewire\Frontend\Work\Tag;
use App\Models\Profile;
use App\Models\User;
use App\Services\QudratService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/digital-library/list-posts', ListPosts::class)->name('digital-library.list-posts');

Route::get('/language/{locale}', function ($locale) {
    session()->put('lang', $locale);

    return redirect()->back();
})->name('locale');

Route::get('/about', \App\Livewire\Frontend\About\Index::class)->name('about.index');
Route::get('/profile/{profile:username}', \App\Livewire\Frontend\Profile\Index::class)->name('profile.index');
Route::get('/digital-library', \App\Livewire\Frontend\DigitalLibrary\Index::class)->name('digital-library.index');
Route::get('/future-skills', \App\Livewire\Frontend\FutureSkills\Index::class)->name('future-skills.index');
Route::get('/media-center', \App\Livewire\Frontend\MediaCenter\Index::class)->name('media-center.index');
Route::get('/social-window', \App\Livewire\Frontend\SocialWindow\Index::class)->name('social-window.index');
Route::get('/jobs', \App\Livewire\Frontend\Jobs\Index::class)->name('jobs.index');
Route::get('/contact', \App\Livewire\Frontend\Contact\Index::class)->name('contact.index');

Route::get('/digital-library/{category:slug}', \App\Livewire\Frontend\DigitalLibrary\Category::class)->name('digital-library.category');
Route::get('/digital-library/{category:slug}/{post:slug}', \App\Livewire\Frontend\DigitalLibrary\Post::class)->name('digital-library.post');

Route::get('/media-center/{post:slug}', Post::class)->name('media-center.post');

Route::get('/work', Index::class)->name('works.index');
Route::get('/work/{work:slug}', Show::class)->name('works.show');
Route::get('/work/category/{category:slug}', \App\Livewire\Frontend\Work\Category::class)->name('works.category');
Route::get('/work/tag/{tag}', Tag::class)->name('works.tag');
Route::get('/work/skill/{skill}', \App\Livewire\Frontend\Work\Skill::class)->name('works.skill');
Route::get('/work/tool/{tool}', \App\Livewire\Frontend\Work\Tool::class)->name('works.tool');

Route::get('/social-window/experts', Experts::class)->name('social-window.experts');
Route::get('/social-window/{category:slug}', Category::class)->name('social-window.category');
Route::get('/social-window/{tool}', Skill::class)->name('social-window.skill');
Route::get('/social-window/{skill}', Tool::class)->name('social-window.tool');
Route::get('/innovators', Innovators::class)->name('social-window.innovators');
Route::get('/researchers', Researchers::class)->name('social-window.researchers');
Route::get('/search', GlobalSearch::class)->name('search');

Route::get('/cv', function () {
    return view('cv-templates.template-1.index', ['profile' => auth()->user()->profile]);
})->name('cv.index');

Route::get('/feedbacks', App\Livewire\Frontend\FeedBack\Index::class)->name('feedbacks.index');

Route::get('/auth/login/callback', LoginCallback::class)->name('auth.login.callback');

Route::get('/otpki', [AuthController::class, 'handleQudratLogoutCallback'])->name('auth.logout.callback');

Route::get('auth/test', function () {
    $response = Http::get('https://qudrat-uat-pki.mol.gov.om/registration', [
        'nationalId' => '4837853',
    ]);

    $xmlString = $response->body(); // Get the raw XML
    $xmlObject = simplexml_load_string($xmlString);
    $json = json_encode($xmlObject, JSON_PRETTY_PRINT);

    $array = json_decode($json, true);
    $collection = collect($array);

    // dd($collection['ListOfEducation']['TRANEDUCATIONDet']);

    dd($collection);

});

Route::get('import', function () {

    try {

        $path = storage_path('app/imports/schoolsm.xlsx');

        // Import the file using the SchoolsImport class
        Excel::import(new SchoolsImport, $path);

        // Return success message
        return back()->with('success', 'Data imported successfully!');
    } catch (Exception $e) {
        dd($e->getMessage());
        Log::error('Import error: '.$e->getMessage());

        return back()->withErrors(['error' => 'An error occurred while importing the file']);
    }
});

Route::get('update-pro', function () {

    $user = auth()->user();

    $qudratService = new QudratService;

    $data = $qudratService->getRegistrationByNationalId('12747519');

    if (! $data) {
        return response()->json(['error' => 'Failed to fetch or parse data'], 500);
    } else {
        $experiences = $data['listOfExp']['EXPDETAILS'] ?? [];

        // dd($experiences);

        foreach ($experiences as $index => $exp) {

            // Clean up values
            $startDate = is_string($exp['StartDate'] ?? null) && ! empty($exp['StartDate'] ?? null)
            ? Carbon::parse($exp['StartDate'] ?? null)->format('Y-m-d')
            : null;
            $endDate = is_string($exp['EndDate'] ?? null) && ! empty($exp['EndDate'] ?? null)
            ? Carbon::parse($exp['EndDate'] ?? null)->format('Y-m-d')
            : null;
            $company = is_string($exp['SponsorName'] ?? null) ? trim($exp['SponsorName'] ?? null) : null;
            $position = is_string($exp['OccupDesc'] ?? null) ? trim($exp['OccupDesc'] ?? null) : null;

            // Determine if current job (no end date = still working)
            $isCurrent = $endDate === null;

            // Insert into the database
            App\Models\Experience::create([
                'profile_id' => auth()->user()->profile->id,
                'company' => $company,
                'position' => $position,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'is_current' => $isCurrent,
                'description' => null,
                'sort' => 0,
                'addable_type' => User::class,
                'addable_id' => auth()->user()->profile->id,
            ]);
        }
    }
});

Route::get('run-event', function () {
    event(new App\Events\UserRegistered(auth()->user()));
});

Route::get('/xprofile/{id}', function ($id) {
    $profile = Profile::with([
        'user',
        'skills',
        'languages',
        'tools',
        'interests',
        'views',
        'works.skills',
        'educations.school',
        'educations.educationType',
        'educations.fieldOfStudy',
        'educations.fieldOfStudyChild',
        'experiences',
        'certificates',
        'courses',
        'achievements',
        'ratings.user.profile',
    ])->findOrFail($id);

    return response()->json([
        'id' => $profile->id,
        'fullname' => $profile->fullname,
        'username' => $profile->username,
        'email' => $profile->email,
        'phone' => $profile->phone,
        'position' => $profile->position,
        'address' => $profile->address,
        'avatar' => $profile->getThumbnailImage(),
        'video' => $profile->video ? asset('uploads/'.$profile->video) : null,
        'website' => $profile->website,
        'social' => [
            'facebook' => $profile->social_facebook,
            'instagram' => $profile->social_instagram,
            'x' => $profile->social_x,
            'linkedin' => $profile->social_linkedin,
            'pinterest' => $profile->social_pinterest,
            'stackoverflow' => $profile->social_stackoverflow,
            'whatsapp' => $profile->social_whatsapp,
        ],
        'bio' => $profile->bio,
        'skills' => $profile->skills()->pluck('name'),
        'languages' => $profile->languages()->pluck('name'),
        'tools' => $profile->tools()->pluck('name'),
        'interests' => $profile->interests()->pluck('name'),
        'views_count' => $profile->views->count(),
        'works_count' => $profile->works->count(),
        'works' => $profile->works->map(function ($work) {
            return [
                'title' => $work->title,
                'cover' => asset('uploads/'.$work->cover),
                'category' => $work->workCategory->name ?? null,
                'skills' => $work->skills->pluck('name'),
                'created_at' => $work->created_at->toDateTimeString(),
            ];
        }),
        'educations' => $profile->educations->map(function ($education) {
            return [
                'education_type' => $education->educationType->name ?? null,
                'field' => $education->fieldOfStudy->name ?? null,
                'sub_field' => $education->fieldOfStudyChild->name ?? null,
                'school' => $education->school->name ?? null,
                'start_date' => $education->start_date,
                'end_date' => $education->end_date,
            ];
        }),
        'experiences' => $profile->experiences->map(function ($exp) {
            return [
                'position' => $exp->position,
                'company' => $exp->company,
                'start_date' => $exp->start_date,
                'end_date' => $exp->is_current ? 'Present' : $exp->end_date,
            ];
        }),
        'certificates' => $profile->certificates->map(function ($cert) {
            return [
                'title' => $cert->title,
                'organization' => $cert->organization,
                'file' => $cert->certificate_file ? asset('uploads/'.$cert->certificate_file) : null,
            ];
        }),
        'courses' => $profile->courses->map(function ($course) {
            return [
                'title' => $course->title,
                'organization' => $course->organization,
                'file' => $course->course_file ? asset('uploads/'.$course->course_file) : null,
            ];
        }),
        'achievements' => $profile->achievements->map(function ($ach) {
            return [
                'title' => $ach->title,
                'description' => $ach->description,
            ];
        }),
        'ratings' => $profile->ratings->map(function ($rating) {
            return [
                'user' => $rating->user->profile->fullname ?? $rating->user->name,
                'avatar' => $rating->user->profile->avatar ?? null,
                'rating' => $rating->rating,
                'comment' => $rating->comment,
                'date' => $rating->created_at->toDateTimeString(),
            ];
        }),
    ]);
});
