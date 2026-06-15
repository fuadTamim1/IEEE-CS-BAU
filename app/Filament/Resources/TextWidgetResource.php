<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TextWidgetResource\Pages;
use App\Models\TextWidget;
use App\Support\AdminRoles;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class TextWidgetResource extends Resource
{
    protected static ?string $model = TextWidget::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Text Widgets';

    protected static ?string $pluralModelLabel = 'Text Widgets';

    protected static ?string $slug = 'text-widgets';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->helperText('Widget identifier (cannot be changed)'),
                Forms\Components\Textarea::make('value')
                    ->required()
                    ->autosize()
                    ->helperText('Enter the text content for this widget'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->wrap()
                    ->limit(50),
            ])
            ->defaultSort('key')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([])
            ->emptyStateHeading('No text widgets found')
            ->emptyStateDescription('Text widgets are used throughout your website.');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTextWidgets::route('/'),
            'edit' => Pages\EditTextWidget::route('/{record}/edit'),
            'view' => Pages\ViewTextWidget::route('/{record}'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }

    public static function canViewAny(): bool
    {
        return static::canManageResource();
    }

    public static function canView($record): bool
    {
        return static::canManageResource();
    }

    public static function canCreate(): bool
    {
        return static::canManageResource();
    }

    public static function canEdit($record): bool
    {
        return static::canManageResource();
    }

    public static function canDelete($record): bool
    {
        return static::canManageResource();
    }

    public static function canDeleteAny(): bool
    {
        return static::canManageResource();
    }

    protected static function canManageResource(): bool
    {
        return Auth::user()?->hasAnyRole(AdminRoles::moderationRoles()) ?? false;
    }
}