<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Pages\{CreateRecord, EditRecord, ListRecords, ViewRecord};

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')

                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                Select::make('title')
                    ->options([
                        "chairperson" => "chairperson",
                        "MD" => "MD",
                        "Treauser" => "Treauser",
                        "Member" => "Member"
                    ]),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->maxLength(255)
                    ->hiddenOn('edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
            // 'view' => ViewUss::route('/{record}'),
        ];
    }

    public static function authorizeResourceAccess(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'super_admin']);
    }
}
