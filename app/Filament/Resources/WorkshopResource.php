<?php

namespace App\Filament\Resources;

use App\Enums\PublicationStatus;
use App\Filament\Resources\WorkshopResource\Pages;
use App\Models\Workshop;
use App\Support\AdminRoles;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Facades\Auth;

class WorkshopResource extends Resource
{
    protected static ?string $model = Workshop::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->required()->columnSpanFull(),
            Textarea::make('description')->rows(3)->columnSpanFull(),
            TiptapEditor::make('content')
                ->profile('default')
                ->output(TiptapOutput::Html)
                ->columnSpanFull(),
            DateTimePicker::make('start_at'),
            DateTimePicker::make('end_at'),
            TextInput::make('location'),
            Select::make('publication_status')
                ->label('Publication Status')
                ->options(PublicationStatus::options())
                ->default(PublicationStatus::DRAFT->value)
                ->required()
                ->visible(fn(): bool => static::canModerate()),
            Textarea::make('rejection_note')
                ->rows(4)
                ->columnSpanFull()
                ->disabled(fn(): bool => !static::canModerate())
                ->helperText('Required when rejecting workshop submissions.'),
            TextInput::make('tags')->helperText('Comma-separated tags')->columnSpanFull(),
            FileUpload::make('cover')
                ->image()
                ->imageEditor()
                ->required()
                ->columnSpanFull(),
            FileUpload::make('images')
                ->image()
                ->multiple()
                ->imageEditor()
                ->reorderable()
                ->columnSpanFull(),
            TextInput::make('host_name')->columnSpanFull(),
            TextInput::make('host_title')->columnSpanFull(),
            Textarea::make('host_bio')->rows(3)->columnSpanFull(),
            FileUpload::make('host_image')->image()->imageEditor()->columnSpanFull(),
            TextInput::make('google_form_url')->url()->prefix('https://')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->limit(35),
                Tables\Columns\TextColumn::make('slug')->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('publication_status')
                    ->label('Publication')
                    ->badge()
                    ->formatStateUsing(fn(?string $state): string => PublicationStatus::tryFrom($state ?? '')?->label() ?? PublicationStatus::DRAFT->label())
                    ->color(fn(?string $state): string => PublicationStatus::tryFrom($state ?? '')?->color() ?? PublicationStatus::DRAFT->color())
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('end_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('reviewedBy.name')
                    ->label('Reviewed By')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('publication_status')
                    ->label('Publication')
                    ->options(PublicationStatus::options()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('submitForReview')
                    ->label('Submit')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('warning')
                    ->visible(fn(Workshop $record): bool =>
                        !static::canModerate()
                        && in_array(static::resolvePublicationStatus($record), [PublicationStatus::DRAFT->value, PublicationStatus::REJECTED->value], true)
                    )
                    ->requiresConfirmation()
                    ->action(function (Workshop $record): void {
                        $record->update([
                            'publication_status' => PublicationStatus::PENDING_REVIEW->value,
                            'submitted_at' => now(),
                            'rejection_note' => null,
                            'reviewed_by' => null,
                            'reviewed_at' => null,
                        ]);

                        Notification::make()
                            ->title('Workshop submitted for review.')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('approve')
                    ->label('Approve & Publish')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn(Workshop $record): bool =>
                        static::canModerate() && static::resolvePublicationStatus($record) === PublicationStatus::PENDING_REVIEW->value
                    )
                    ->requiresConfirmation()
                    ->action(function (Workshop $record): void {
                        $record->update([
                            'publication_status' => PublicationStatus::PUBLISHED->value,
                            'reviewed_by' => Auth::id(),
                            'reviewed_at' => now(),
                            'rejection_note' => null,
                        ]);

                        Notification::make()
                            ->title('Workshop approved and published.')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn(Workshop $record): bool =>
                        static::canModerate() && static::resolvePublicationStatus($record) === PublicationStatus::PENDING_REVIEW->value
                    )
                    ->form([
                        Textarea::make('rejection_note')
                            ->label('Rejection Note')
                            ->required()
                            ->rows(5)
                            ->maxLength(2000),
                    ])
                    ->action(function (Workshop $record, array $data): void {
                        $record->update([
                            'publication_status' => PublicationStatus::REJECTED->value,
                            'rejection_note' => $data['rejection_note'],
                            'reviewed_by' => Auth::id(),
                            'reviewed_at' => now(),
                        ]);

                        Notification::make()
                            ->title('Workshop rejected and note saved.')
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

    protected static function resolvePublicationStatus(Workshop $record): string
    {
        return $record->publication_status
            ?: ($record->is_published ? PublicationStatus::PUBLISHED->value : PublicationStatus::DRAFT->value);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkshops::route('/'),
            'create' => Pages\CreateWorkshop::route('/create'),
            'edit' => Pages\EditWorkshop::route('/{record}/edit'),
        ];
    }
}
