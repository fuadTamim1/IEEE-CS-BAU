<?php

namespace App\Filament\Resources;

use App\Enums\PublicationStatus;
use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use App\Support\AdminRoles;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Facades\Auth;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Project Information')
                    ->description('Basic details about the project.')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('description')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TagsInput::make('tags')->separator(','),

                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'title'),
                    ]),

                Forms\Components\Section::make('Project Details') // 🆕 New Sub-header
                    ->description('Information about the project creator, location, cost, and timeframe.')
                    ->collapsible() // Makes it collapsible for better UI
                    ->schema([
                        Forms\Components\TagsInput::make('created_by')
                            ->label('Created By')
                            ->placeholder('Enter members name')
                            ->separator()
                            ->nullable(),

                        Forms\Components\TextInput::make('cost')
                            ->label('Project Cost')
                            ->numeric()
                            ->prefix('$')
                            ->nullable()
                            ->step(0.01)
                            ->placeholder('Enter cost in USD'),

                        Forms\Components\TextInput::make('location')
                            ->label('Project Location')
                            ->nullable()
                            ->placeholder('Enter location'),

                        Forms\Components\DatePicker::make('timeframe')
                            ->label('Timeframe')
                            ->nullable()
                            ->native(false)
                            ->placeholder('Select project timeframe'),

                        Forms\Components\TextInput::make('link')
                            ->label('Project Link')
                            ->nullable()
                            ->placeholder('Enter Link: https://github.com/r/something'),
                    ]),

                Forms\Components\Section::make('Content & Media')
                    ->description('Project description, images, and attachments.')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('projects')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull()
                            ->preserveFilenames()
                            ->disk('public')
                            ->hiddenOn(['edit']),
                    ]),

                Forms\Components\Select::make('publication_status')
                    ->label('Publication Status')
                    ->options(PublicationStatus::options())
                    ->default(PublicationStatus::DRAFT->value)
                    ->required()
                    ->visible(fn (): bool => static::canModerate()),

                Forms\Components\Textarea::make('rejection_note')
                    ->rows(4)
                    ->columnSpanFull()
                    ->disabled(fn (): bool => !static::canModerate())
                    ->helperText('Required when rejecting project submissions.'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->size(40)
                    ->circular()
                    ->defaultImageUrl(asset('images/profile.png'))
                    ->visibility('public'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->description(fn(Project $record): string => Str::limit($record->description, 50)),

                Tables\Columns\TextColumn::make('category.title')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Design' => 'info',
                        'Development' => 'success',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tags')
                    ->badge()
                    ->separator(',')
                    ->searchable()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('publication_status')
                    ->badge()
                    ->sortable()
                    ->label('Publication')
                    ->formatStateUsing(fn(?string $state): string => PublicationStatus::tryFrom($state ?? '')?->label() ?? PublicationStatus::DRAFT->label())
                    ->color(fn(?string $state): string => PublicationStatus::tryFrom($state ?? '')?->color() ?? PublicationStatus::DRAFT->color()),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'title'),

                SelectFilter::make('publication_status')
                    ->label('Publication')
                    ->options(PublicationStatus::options()),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('submitForReview')
                        ->label('Submit')
                        ->icon('heroicon-o-paper-airplane')
                        ->color('warning')
                        ->visible(fn(Project $record): bool =>
                            !static::canModerate()
                            && in_array(static::resolvePublicationStatus($record), [PublicationStatus::DRAFT->value, PublicationStatus::REJECTED->value], true)
                        )
                        ->requiresConfirmation()
                        ->action(function (Project $record): void {
                            $record->update([
                                'publication_status' => PublicationStatus::PENDING_REVIEW->value,
                                'submitted_at' => now(),
                                'rejection_note' => null,
                                'reviewed_by' => null,
                                'reviewed_at' => null,
                            ]);

                            Notification::make()
                                ->title('Project submitted for review.')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\Action::make('approve')
                        ->label('Approve & Publish')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn(Project $record): bool =>
                            static::canModerate() && static::resolvePublicationStatus($record) === PublicationStatus::PENDING_REVIEW->value
                        )
                        ->requiresConfirmation()
                        ->action(function (Project $record): void {
                            $record->update([
                                'publication_status' => PublicationStatus::PUBLISHED->value,
                                'reviewed_by' => Auth::id(),
                                'reviewed_at' => now(),
                                'rejection_note' => null,
                            ]);

                            Notification::make()
                                ->title('Project approved and published.')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\Action::make('reject')
                        ->label('Reject')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->visible(fn(Project $record): bool =>
                            static::canModerate() && static::resolvePublicationStatus($record) === PublicationStatus::PENDING_REVIEW->value
                        )
                        ->form([
                            Forms\Components\Textarea::make('rejection_note')
                                ->label('Rejection Note')
                                ->required()
                                ->rows(5)
                                ->maxLength(2000),
                        ])
                        ->action(function (Project $record, array $data): void {
                            $record->update([
                                'publication_status' => PublicationStatus::REJECTED->value,
                                'rejection_note' => $data['rejection_note'],
                                'reviewed_by' => Auth::id(),
                                'reviewed_at' => now(),
                            ]);

                            Notification::make()
                                ->title('Project rejected and note saved.')
                                ->warning()
                                ->send();
                        }),
                    Tables\Actions\Action::make('publish')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->action(fn(Project $record) => $record->update([
                            'publication_status' => PublicationStatus::PUBLISHED->value,
                            'reviewed_by' => Auth::id(),
                            'reviewed_at' => now(),
                            'rejection_note' => null,
                        ]))
                        ->hidden(fn(Project $record): bool => static::resolvePublicationStatus($record) === PublicationStatus::PUBLISHED->value),
                    Tables\Actions\Action::make('unpublish')
                        ->icon('heroicon-m-x-circle')
                        ->color('danger')
                        ->action(fn(Project $record) => $record->update(['publication_status' => PublicationStatus::DRAFT->value]))
                        ->hidden(fn(Project $record): bool => static::resolvePublicationStatus($record) !== PublicationStatus::PUBLISHED->value),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('publish')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->action(fn(Collection $records) => $records->each->update([
                            'publication_status' => PublicationStatus::PUBLISHED->value,
                            'reviewed_by' => Auth::id(),
                            'reviewed_at' => now(),
                            'rejection_note' => null,
                        ])),
                    Tables\Actions\BulkAction::make('unpublish')
                        ->icon('heroicon-m-x-circle')
                        ->color('danger')
                        ->action(fn(Collection $records) => $records->each->update([
                            'publication_status' => PublicationStatus::DRAFT->value,
                        ])),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('No projects yet')
            ->emptyStateDescription('Create your first project by clicking the button below')
            ->emptyStateIcon('heroicon-o-document')
            ->deferLoading()
            ->persistSearchInSession()
            ->persistColumnSearchesInSession();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }

    public static function canViewAny(): bool
    {
        return static::canModerate();
    }

    public static function canView($record): bool
    {
        return static::canModerate();
    }

    public static function canCreate(): bool
    {
        return static::canModerate();
    }

    public static function canEdit($record): bool
    {
        return static::canModerate();
    }

    public static function canDelete($record): bool
    {
        return static::canModerate();
    }

    public static function canDeleteAny(): bool
    {
        return static::canModerate();
    }

    protected static function canModerate(): bool
    {
        return Auth::user()?->hasAnyRole(AdminRoles::moderationRoles()) ?? false;
    }

    protected static function resolvePublicationStatus(Project $record): string
    {
        return $record->publication_status
            ?: ($record->is_published ? PublicationStatus::PUBLISHED->value : PublicationStatus::DRAFT->value);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
