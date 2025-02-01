<?php

namespace App\CmsPages\Templates;

use Filament\Forms;
use SolutionForest\FilamentCms\CmsPages\Contracts\CmsPageTemplate;
use SolutionForest\FilamentCms\CmsPages\Renderer\AtomicDesignPageRenderer;

final class AboutPage implements CmsPageTemplate
{
    protected static ?string $view = null;

    public static function title(): string
    {
        return 'AboutPage';
    }

    public static function schema(): array
    {
        return [
            Forms\Components\Section::make('Page Title')
                ->schema([
                    Forms\Components\TextInput::make('page_title'),
                    Forms\Components\TextInput::make('page_description'),
                    Forms\Components\FileUpload::make('page_image'),
                ]),
            Forms\Components\Section::make('Sponsors Section')
                ->schema([
                    Forms\Components\TextInput::make('sponsors_title'),
                    Forms\Components\FileUpload::make('sponsors_images')
                        ->image()
                        ->multiple(),
                ]),
            Forms\Components\Section::make('About Section')
                ->schema([
                    Forms\Components\TextInput::make('about_title'),
                    Forms\Components\Repeater::make('about_items')
                        ->schema([
                            Forms\Components\TextInput::make('title'),
                            Forms\Components\RichEditor::make('description'),
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

            Forms\Components\Section::make('Call to Action Section')
                ->schema([
                    Forms\Components\TextInput::make('cta_1_title'),
                    Forms\Components\TextInput::make('cta_1_description'),
                    Forms\Components\TextInput::make('cta_1_button_text'),
                    Forms\Components\TextInput::make('cta_1_button_link'),

                    Forms\Components\TextInput::make('cta_2_title'),
                    Forms\Components\TextInput::make('cta_2_description'),
                    Forms\Components\TextInput::make('cta_2_button_text'),
                    Forms\Components\TextInput::make('cta_2_button_link'),
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
