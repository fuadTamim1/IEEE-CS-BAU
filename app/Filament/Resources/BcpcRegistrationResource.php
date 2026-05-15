<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BcpcRegistrationResource\Pages;
use App\Models\Bcpc\BcpcRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BcpcRegistrationResource extends Resource
{
    protected static ?string $model = BcpcRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static ?string $navigationLabel = 'BCPC Registrations';

    protected static ?string $modelLabel = 'BCPC Registration';

    protected static ?string $pluralModelLabel = 'BCPC Registrations';

    protected static ?string $slug = 'bcpc-registrations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('team_name')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('captain_name')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('captain_email')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('captain_university_id')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('member_two_name')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('member_three_name')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\TextInput::make('team_size')
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\Select::make('status')
                    ->options(BcpcRegistration::statusOptions())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('team_name')
                    ->label('Team')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (?string $state, BcpcRegistration $record): string => $state ?: ($record->full_name ?: 'N/A')),
                Tables\Columns\TextColumn::make('captain_name')
                    ->label('Captain')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (?string $state, BcpcRegistration $record): string => $state ?: ($record->full_name ?: 'N/A')),
                Tables\Columns\TextColumn::make('captain_email')
                    ->label('Captain Email')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('captain_university_id')
                    ->label('Captain ID')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('team_size')
                    ->label('Team Size')
                    ->badge()
                    ->color(fn (?string $state): string => (int) $state === 3 ? 'info' : 'primary'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'submitted' => 'warning',
                        'disqualified' => 'gray',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(BcpcRegistration::statusOptions()),
                SelectFilter::make('team_size')
                    ->options([
                        2 => '2 Members',
                        3 => '3 Members',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBcpcRegistrations::route('/'),
            'edit' => Pages\EditBcpcRegistration::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
