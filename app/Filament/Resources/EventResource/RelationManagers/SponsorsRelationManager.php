<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SponsorsRelationManager extends RelationManager
{
    protected static string $relationship = 'sponsors';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tier')
                    ->options(self::tierOptions())
                    ->required()
                    ->default('partner'),
                Forms\Components\TextInput::make('display_order')
                    ->label('Display Order')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(30),
                Tables\Columns\TextColumn::make('pivot.tier')
                    ->label('Tier')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'platinum' => 'gray',
                        'gold' => 'warning',
                        'silver' => 'info',
                        'bronze' => 'success',
                        default => 'primary',
                    }),
                Tables\Columns\TextColumn::make('pivot.display_order')
                    ->label('Order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('website')
                    ->url(fn ($state): ?string => $state ?: null)
                    ->openUrlInNewTab(),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['name', 'descrition', 'description'])
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\Select::make('tier')
                            ->options(self::tierOptions())
                            ->required()
                            ->default('partner'),
                        Forms\Components\TextInput::make('display_order')
                            ->label('Display Order')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->default(0),
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('editLink')
                    ->label('Edit Link')
                    ->icon('heroicon-o-adjustments-horizontal')
                    ->fillForm(fn ($record): array => [
                        'tier' => $record->pivot->tier ?? 'partner',
                        'display_order' => (int) ($record->pivot->display_order ?? 0),
                    ])
                    ->form([
                        Forms\Components\Select::make('tier')
                            ->options(self::tierOptions())
                            ->required(),
                        Forms\Components\TextInput::make('display_order')
                            ->label('Display Order')
                            ->numeric()
                            ->required()
                            ->minValue(0),
                    ])
                    ->action(function ($record, array $data): void {
                        $this->getRelationship()->updateExistingPivot($record->getKey(), [
                            'tier' => $data['tier'],
                            'display_order' => (int) $data['display_order'],
                        ]);
                    }),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }

    /**
     * @return array<string, string>
     */
    protected static function tierOptions(): array
    {
        return [
            'partner' => 'Partner',
            'bronze' => 'Bronze',
            'silver' => 'Silver',
            'gold' => 'Gold',
            'platinum' => 'Platinum',
        ];
    }
}
