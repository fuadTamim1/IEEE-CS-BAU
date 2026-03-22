<?php

namespace App\Filament\Resources;

use App\Enums\BlogStatus;
use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\Grid::make(2)
                    ->schema([
                        TagsInput::make('tags')
                            ->separator(',')
                            ->columnSpan(1),

                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'title')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),
                    ]),

                Select::make('author_member_id')
                    ->label('Display Author (Member)')
                    ->options(fn() => Member::query()->orderBy('name')->pluck('name', 'id')->all())
                    ->searchable()
                    ->preload()
                    ->helperText('Optional: if selected, this member name will appear as the blog author on website.'),

                FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->imageEditorEmptyFillColor("#FAA41A"),

                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),

                Select::make('status')
                    ->options(BlogStatus::options())
                    ->default(BlogStatus::DRAFT->value)
                    ->visible(fn() => static::canModerate())
                    ->required(),

                Textarea::make('rejection_note')
                    ->rows(4)
                    ->columnSpanFull()
                    ->disabled(fn() => !static::canModerate())
                    ->helperText('Used only when a post is rejected.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query): Builder {
                if (!static::canModerate()) {
                    return $query->where('author_id', Auth::id());
                }

                return $query;
            })
            ->columns([
                TextColumn::make('title')->searchable()->sortable()->limit(45),
                TextColumn::make('display_author_name')
                    ->label('Author')
                    ->toggleable(),
                TextColumn::make('tags')->badge()->toggleable(),
                TextColumn::make('category.title')
                    ->label('Category')
                    ->sortable()
                    ->searchable()
                    ->default('No Category')
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => BlogStatus::tryFrom($state)?->label() ?? $state)
                    ->color(fn(string $state) => BlogStatus::tryFrom($state)?->color() ?? 'gray')
                    ->sortable(),
                TextColumn::make('reviewedBy.name')
                    ->label('Reviewed By')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reviewed_at')
                    ->label('Reviewed At')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('image')
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(BlogStatus::options()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('submitForReview')
                    ->label('Submit')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('warning')
                    ->visible(fn(Blog $record): bool =>
                        !static::canModerate() && in_array($record->status, [BlogStatus::DRAFT->value, BlogStatus::REJECTED->value], true)
                    )
                    ->requiresConfirmation()
                    ->action(function (Blog $record): void {
                        $record->update([
                            'status' => BlogStatus::PENDING_REVIEW->value,
                            'submitted_at' => now(),
                            'rejection_note' => null,
                            'reviewed_by' => null,
                            'reviewed_at' => null,
                        ]);

                        Notification::make()
                            ->title('Post submitted for admin review.')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('approve')
                    ->label('Approve & Publish')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn(Blog $record): bool =>
                        static::canModerate() && $record->status === BlogStatus::PENDING_REVIEW->value
                    )
                    ->requiresConfirmation()
                    ->action(function (Blog $record): void {
                        $record->update([
                            'status' => BlogStatus::PUBLISHED->value,
                            'reviewed_by' => Auth::id(),
                            'reviewed_at' => now(),
                            'rejection_note' => null,
                        ]);

                        if ($record->author) {
                            Notification::make()
                                ->title('Your blog post was approved and published.')
                                ->success()
                                ->sendToDatabase($record->author);
                        }

                        Notification::make()
                            ->title('Post approved and published.')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn(Blog $record): bool =>
                        static::canModerate() && $record->status === BlogStatus::PENDING_REVIEW->value
                    )
                    ->form([
                        Textarea::make('rejection_note')
                            ->label('Rejection Note')
                            ->required()
                            ->rows(5)
                            ->maxLength(2000),
                    ])
                    ->action(function (Blog $record, array $data): void {
                        $record->update([
                            'status' => BlogStatus::REJECTED->value,
                            'rejection_note' => $data['rejection_note'],
                            'reviewed_by' => Auth::id(),
                            'reviewed_at' => now(),
                        ]);

                        if ($record->author) {
                            Notification::make()
                                ->title('Your blog post was rejected.')
                                ->body($data['rejection_note'])
                                ->warning()
                                ->sendToDatabase($record->author);
                        }

                        Notification::make()
                            ->title('Post rejected and note saved.')
                            ->warning()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }

    protected static function canModerate(): bool
    {
        return Auth::user()?->hasAnyRole(['super-admin', 'admin', 'editor']) ?? false;
    }
}
