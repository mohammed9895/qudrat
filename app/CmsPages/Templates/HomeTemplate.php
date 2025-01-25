<?php

namespace App\CmsPages\Templates;

use Filament\Forms;
use SolutionForest\FilamentCms\CmsPages\Contracts\CmsPageTemplate;
use SolutionForest\FilamentCms\CmsPages\Renderer\AtomicDesignPageRenderer;

final class HomeTemplate implements CmsPageTemplate
{
    protected static ?string $view = null;

    public static function title(): string
    {
        return 'HomeTemplate';
    }

    public static function schema(): array
    {
        return [
            Forms\Components\Section::make('Hero Section')
                ->schema([
                    Forms\Components\RichEditor::make('main_title'),
                    Forms\Components\Textarea::make('secondary_title'),
                    Forms\Components\FileUpload::make('hero_image'),
                ]),
            Forms\Components\Section::make('Sponsors Section')
                ->schema([
                    Forms\Components\TextInput::make('sponsors_title'),
                    Forms\Components\FileUpload::make('sponsors_images')
                        ->image()
                        ->multiple(),
                ]),
            Forms\Components\Section::make('Talent Section')
                ->schema([
                    Forms\Components\TextInput::make('talent_title'),
                    Forms\Components\Textarea::make('talent_description'),
                    Forms\Components\TextInput::make('talents_per_category')->integer(),
                ]),
            Forms\Components\Section::make('About Section')
                ->schema([
                    Forms\Components\TextInput::make('about_title'),
                    Forms\Components\Textarea::make('about_description'),
                    Forms\Components\FileUpload::make('about_image'),
                    Forms\Components\Repeater::make('about_items')
                        ->schema([
                            Forms\Components\TextInput::make('title'),
                            Forms\Components\Textarea::make('description'),
                            Forms\Components\FileUpload::make('image'),
                        ]),
                ]),

            Forms\Components\Section::make('Steps Section')
                ->schema([
                    Forms\Components\TextInput::make('steps_title'),
                    Forms\Components\Textarea::make('steps_description'),
                    Forms\Components\TextInput::make('steps_button_text'),
                    Forms\Components\TextInput::make('steps_button_url')->url(),
                    Forms\Components\Repeater::make('steps')
                        ->schema([
                            Forms\Components\TextInput::make('title'),
                            Forms\Components\Textarea::make('description'),
                            Forms\Components\Textarea::make('number'),
                            Forms\Components\FileUpload::make('image'),
                        ]),
                ]),

            Forms\Components\Section::make('Testimonials Section')
                ->schema([
                    Forms\Components\TextInput::make('testimonials_title'),
                    Forms\Components\Textarea::make('testimonials_description'),
                    Forms\Components\FileUpload::make('testimonials_image'),
                    Forms\Components\Repeater::make('testimonials')
                        ->collapsible()
                        ->cloneable()
                        ->schema([
                            Forms\Components\TextInput::make('name'),
                            Forms\Components\TextInput::make('position'),
                            Forms\Components\Textarea::make('description'),
                            Forms\Components\FileUpload::make('image'),
                        ]),
                ]),

            Forms\Components\Section::make('Features Section')
                ->schema([
                    Forms\Components\TextInput::make('features_title'),
                    Forms\Components\Textarea::make('features_description'),
                    Forms\Components\FileUpload::make('features_image'),
                    Forms\Components\Repeater::make('features')
                        ->schema([
                            Forms\Components\TextInput::make('title'),
                            Forms\Components\TextInput::make('subtitle'),
                            Forms\Components\FileUpload::make('icon'),
                        ]),
                ]),

            Forms\Components\Section::make('Map Section')
                ->schema([
                    Forms\Components\TextInput::make('map_title'),
                    Forms\Components\Textarea::make('map_description'),
                    //                    Forms\Components\FileUpload::make('map_image'),
                    Forms\Components\TextInput::make('map_button_text'),
                    Forms\Components\TextInput::make('map_button_url')->url(),
                ]),

            Forms\Components\Section::make('FAQ Section')
                ->schema([
                    Forms\Components\TextInput::make('faq_title'),
                    Forms\Components\Textarea::make('faq_description'),
                    Forms\Components\Repeater::make('faq')
                        ->schema([
                            Forms\Components\TextInput::make('question'),
                            Forms\Components\Textarea::make('answer'),
                        ]),
                ]),
        ];
    }

    public static function getRenderer(): ?string
    {
        return self::$view ?? AtomicDesignPageRenderer::class;
    }

    public static function hiddenOnTemplateOptions(): bool
    {
        return false;
    }
}
