<?php

namespace App\CmsPages\Templates;

use Filament\Forms;
use Guava\FilamentIconPicker\Forms\IconPicker;
use SolutionForest\FilamentCms\CmsPages\Contracts\CmsPageTemplate;
use SolutionForest\FilamentCms\CmsPages\Renderer\AtomicDesignPageRenderer;

final class FutureSkills implements CmsPageTemplate
{
    protected static ?string $view = null;

    public static function title(): string
    {
        return 'FutureSkills';
    }

    public static function schema(): array
    {
        return [
            Forms\Components\Section::make('Main Categories')
                ->schema([
                    Forms\Components\TextInput::make('main_title'),
                    Forms\Components\TextInput::make('main_description'),
                    Forms\Components\Repeater::make('categories')
                        ->schema([
                            Forms\Components\TextInput::make('title'),
                            Forms\Components\TextInput::make('link'),
                            IconPicker::make('icon'),
                        ]),
                ]),
            Forms\Components\Section::make('Future Skills Recommendation')
                ->schema([
                    Forms\Components\TextInput::make('recommendation_title'),
                    Forms\Components\TextInput::make('recommendation_description'),
                    Forms\Components\Repeater::make('recommendation_items')
                        ->schema([
                            Forms\Components\FileUpload::make('image'),
                            Forms\Components\TextInput::make('title'),
                            Forms\Components\RichEditor::make('content'),
                            Forms\Components\TextInput::make('link'),
                        ]),
                ]),
            Forms\Components\Section::make('Future Skills Chart')
                ->schema([
                    Forms\Components\TextInput::make('chart_main_title'),
                    Forms\Components\TextInput::make('chart_main_description'),
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
