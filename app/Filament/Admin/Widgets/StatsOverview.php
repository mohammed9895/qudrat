<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Achievement;
use App\Models\Category;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\DigitalLibraryCategory;
use App\Models\DigitalLibraryLink;
use App\Models\DigitalLibraryPost;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use App\Models\MediaCenterComment;
use App\Models\MediaCenterPost;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Tool;
use App\Models\User;
use App\Models\Work;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            BaseWidget\Stat::make('Users', User::count())
                ->color('primary')
                ->icon('heroicon-o-users'),
            BaseWidget\Stat::make('Profiles', Profile::count())
                ->color('success')
                ->icon('heroicon-o-user-group'),
            BaseWidget\Stat::make('International Profiles', Profile::where('international_profile', true)->count())
                ->color('info')
                ->icon('heroicon-o-globe-alt'),
            BaseWidget\Stat::make('Male Users', Profile::where('gender', 0)->count())->icon('heroicon-o-user-group'),
            BaseWidget\Stat::make('Female Users', Profile::where('gender', 1)->count())->icon('heroicon-o-user-group'),
            BaseWidget\Stat::make('Expert', Profile::where('is_expert', 1)->count())->icon('heroicon-o-user-group'),
            BaseWidget\Stat::make('Work', Work::count())
                ->color('warning')
                ->icon('heroicon-o-briefcase'),
            BaseWidget\Stat::make('Used Categories', Category::has('profiles')->count())
                ->color('danger')
                ->icon('heroicon-o-tag'),
            BaseWidget\Stat::make('Used Skills', Skill::has('profiles')->count())
                ->color('gray')
                ->icon('heroicon-o-sparkles'),
            BaseWidget\Stat::make('Used Tools', Tool::has('profiles')->count())
                ->color('primary')
                ->icon('heroicon-o-wrench'),
            BaseWidget\Stat::make('User Languages', Language::has('profile')->count())
                ->color('success')
                ->icon('heroicon-o-language'),
            BaseWidget\Stat::make('Digital Libraries', DigitalLibraryLink::count())
                ->color('info')
                ->icon('heroicon-o-book-open'),
            BaseWidget\Stat::make('Digital Library Categories', DigitalLibraryCategory::count())
                ->color('danger')
                ->icon('heroicon-o-folder'),
            BaseWidget\Stat::make('Digital Library Posts', DigitalLibraryPost::count())
                ->color('warning')
                ->icon('heroicon-o-document-text'),
            BaseWidget\Stat::make('Media Center Posts', MediaCenterPost::count())
                ->color('gray')
                ->icon('heroicon-o-photo'),
            BaseWidget\Stat::make('Media Center Comments', MediaCenterComment::count())
                ->color('primary')
                ->icon('heroicon-o-chat-bubble-left'),
            BaseWidget\Stat::make('Educations', Education::count())
                ->color('success')
                ->icon('heroicon-o-academic-cap'),
            BaseWidget\Stat::make('Experiences', Experience::count())
                ->color('info')
                ->icon('heroicon-o-briefcase'),
            BaseWidget\Stat::make('Achievements', Achievement::count())
                ->color('danger')
                ->icon('heroicon-o-trophy'),
            BaseWidget\Stat::make('Courses', Course::count())
                ->color('warning')
                ->icon('heroicon-o-book-open'),
            BaseWidget\Stat::make('Certifications', Certificate::count())
                ->color('gray')
                ->icon('heroicon-o-document-text'),
        ];
    }
}
