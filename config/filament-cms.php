<?php

use App\Filament\Admin\Resources\CmsPageResource;
use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use SolutionForest\FilamentCms\CmsPages\Renderer;
use SolutionForest\FilamentCms\CmsPages\Templates;
use SolutionForest\FilamentCms\Filament\Resources;
use SolutionForest\FilamentCms\Http\Middleware;
use SolutionForest\FilamentCms\Models;

return [

    'theme' => 'default',

    'default_layout' => 'app',

    'locales' => [
        'ar',
        'en',
    ],

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Middleware for front-end pages
    |
    */
    'middleware' => [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            LocaleMiddleware::class,
        ],
    ],

    'filament' => [
        'resources' => [
            'cms_page' => CmsPageResource::class,
            'cms_page_navigation_category' => Resources\CmsPageNavigationCategoryResource::class,
            'cms_tag' => Resources\CmsTagResource::class,
        ],
        'navigation' => [
            'icon' => [
                Resources\CmsPageResource::class => 'heroicon-o-document',
                Resources\CmsPageNavigationCategoryResource::class => 'heroicon-o-bars-3-center-left',
                Resources\CmsTagResource::class => 'heroicon-o-tag',
            ],
            'sort' => [
                Resources\CmsPageResource::class => -10,
                Resources\CmsTagResource::class => -9,
                Resources\CmsPageNavigationCategoryResource::class => -8,
            ],
        ],
        'recordTitleAttribute' => [
            'cms_page' => 'title',
            'cms_navigation_category' => 'title',
            'cms_tag' => 'name',
        ],
    ],

    'enable_page_tags' => false,

    'enable_audit_log' => false,

    'cms_pages' => [

        'include_default_template' => true,

        'templates' => [
            Templates\DefaultTemplate::class,
            Templates\BlockTemplate::class,
        ],

        /**
         * Specific the render for the page template
         */
        'renderers' => [
            /**
             * Default render if no specify
             */
            'default' => Renderer\AtomicDesignPageRenderer::class,
            'namespace' => 'App\\CmsPages\\Renderer',
            'path' => app_path('CmsPages/Renderer'),
        ],

        'navigation' => [
            'main_menu' => [
                'enabled' => true,
                'name' => 'main-menu',
            ],
        ],

        'namespace' => 'App\\CmsPages\\Templates',
        'path' => app_path('CmsPages/Templates'),

    ],

    'models' => [
        'cms_page' => App\Models\CmsPage::class,
        'cms_published_page' => Models\CmsPublishedPage::class,
        'cms_page_navigation' => Models\CmsPageNavigation::class,
        'cms_page_navigation_category' => Models\CmsPageNavigationCategory::class,
        'cms_tag' => Models\CmsTag::class,
        'cms_taggable' => Models\CmsTaggable::class,
        'cms_tag_category' => Models\CmsTagCategory::class,
        'seo' => Models\SEO::class,
    ],

    'column_names' => [
        'created_by' => 'created_by',
        'updated_by' => 'updated_by',
    ],

    'cache' => [
        'available_page_slug' => [
            'name' => 'cms_page_available_slug',
            'expiration_time' => DateInterval::createFromDateString('24 hours'),
        ],
    ],
];
