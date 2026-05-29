<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamSessionResource\Pages;
use App\Filament\Resources\ExamSessionResource\RelationManagers;
use App\Models\ExamSession;
use App\Support\AdminRoles;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ExamSessionResource extends Resource
{
    protected static ?string $model = ExamSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListExamSessions::route('/'),
            'create' => Pages\CreateExamSession::route('/create'),
            'edit' => Pages\EditExamSession::route('/{record}/edit'),
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
        return Auth::user()?->hasAnyRole(AdminRoles::managementRoles()) ?? false;
    }
}
