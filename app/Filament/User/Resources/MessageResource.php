<?php

namespace App\Filament\User\Resources;

use App\Filament\Resources\MessageResource\Pages\ViewMessage;
use App\Filament\User\Resources\MessageResource\Pages;
use App\Models\Topic;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MessageResource extends Resource
{
    protected static ?int $navigationSort = 10;

    protected static ?string $model = Topic::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    public static function getNavigationLabel(): string
    {
        return __('general.message-resource.inbox');
    }

    public static function getLabel(): ?string
    {
        return __('general.message-resource.inbox');
    }

    public static function getPluralLabel(): ?string
    {
        return __('general.message-resource.inbox');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('creator.name')
                    ->label(__('general.message-resource.sender')),
                Tables\Columns\TextColumn::make('subject')
                    ->label(__('general.message-resource.subject')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('general.created_at'))
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->recordClasses(function (Topic $record) use ($table): string|null {
                $unreads = collect($table->getRecords()->loadMissing('messages'))
                    ->mapWithKeys(function ($record) {
                        return [$record->id => $record->messages->where('sender_id', '!==', auth()->id())->where('read_at', '===', null)->count()];
                    })
                    ->filter(function ($value) {
                        return $value == true;
                    })
                    ->keys()
                    ->all();

                return in_array($record->id, $unreads) ? 'bg-gray-100' : null;
            })
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                RepeatableEntry::make('messages')
                    ->hiddenLabel()
                    ->schema(fn () => [
                        Grid::make()
                            ->schema([
                                TextEntry::make('sender.name')
                                    ->label(__('general.message-resource.sender'))
                                    ->inlineLabel(),
                                TextEntry::make('created_at')
                                    ->inlineLabel()
                                    ->hiddenLabel()
                                    ->since()
                                    ->alignEnd(),
                            ]),
                        TextEntry::make('content')
                            ->label(__('general.message-resource.content'))
                            ->hiddenLabel(),
                    ])
                    ->columnSpanFull(),
                Actions::make([
                    Action::make('reply')
                        ->label(__('general.message-resource.reply'))
                        ->form([
                            Forms\Components\Textarea::make('content')
                                ->required(),
                        ])
                        ->action(function (Topic $record, array $data): void {
                            $record->messages()->create([
                                'sender_id' => auth()->id(),
                                'content' => $data['content'],
                            ]);

                            // Send notification to the user receiving the message
                            $receiver = (auth()->id() === $record['creator_id']) ? $record['receiver_id'] : $record['creator_id'];

                            Notification::make()
                                ->title(__('general.message-resource.new_reply', ['subject' => $record->subject]))
                                ->sendToDatabase(User::find($receiver));
                        }),
                ])
                    ->columnSpanFull(),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('subject')
                            ->label(__('general.message-resource.subject'))
                            ->unique()
                            ->required(),
                        Forms\Components\Select::make('receiver_id')
                            ->relationship('receiver', 'name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->name} ({$record->email})")
                            ->preload()
                            ->searchable()
                            ->required(),
                        Forms\Components\Textarea::make('messages.content')
                            ->required(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'view' => ViewMessage::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return Topic::query()
            ->where(function ($query) {
                $query->where('creator_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id());
            });
    }

    public static function getNavigationBadge(): ?string
    {
        $topics = static::getModel()::where('creator_id', auth()->id())->orWhere('receiver_id', auth()->id())
            ->with('messages')
            ->get();

        $unreadCount = 0;

        foreach ($topics as $topic) {
            foreach ($topic->messages as $message) {
                if ($message->sender_id !== auth()->id() && $message->read_at === null) {
                    $unreadCount++;
                }
            }
        }

        return $unreadCount;
    }
}
