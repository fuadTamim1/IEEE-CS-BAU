<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaderboardResource\Pages;
use App\Filament\Resources\LeaderboardResource\RelationManagers;
use App\Models\Leaderboard;
use App\Models\Member;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaderboardResource extends Resource
{
    protected static ?string $model = Leaderboard::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('week_start_date')
                    ->label('Week Start Date')
                    ->firstDayOfWeek(1) // Start from Monday
                    ->required()
                    ->default(Carbon::now()) // Start from Monday
                    ->displayFormat("F j, Y")
                    ->format('F j, Y') // Start from Monday
                    ->columnSpanFull(),
                DateTimePicker::make('publish_at')
                    ->label('Publish At (Aisa/Amman Timezone)')
                    ->default(Carbon::now()->addHour()) // Start from Monday
                    ->required()
                    ->columnSpanFull(),
                Select::make("member_1_id")
                    ->label("Top 1 Member")
                    ->relationship('member1', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make("member_2_id")
                    ->label("Top 2 Member")
                    ->relationship('member2', 'name')
                    ->searchable()
                    ->preload(),
                Select::make("member_3_id")
                    ->label("Top 3 Member")
                    ->relationship('member3', 'name')
                    ->searchable()
                    ->preload(),
                Select::make("member_4_id")
                    ->label("Top 4 Member")
                    ->relationship('member4', 'name')
                    ->searchable()
                    ->preload(),
                Select::make("member_5_id")
                    ->label("Top 5 Member")
                    ->relationship('member5', 'name')
                    ->searchable()
                    ->preload(),
                Select::make("member_6_id")
                    ->label("Top 6 Member")
                    ->relationship('member6', 'name')
                    ->searchable()
                    ->preload(),
                Select::make("member_7_id")
                    ->label("Top 7 Member")
                    ->relationship('member7', 'name')
                    ->searchable()
                    ->preload(),
                Select::make("member_8_id")
                    ->label("Top 8 Member")
                    ->relationship('member8', 'name')
                    ->searchable()
                    ->preload(),
                Select::make("member_9_id")
                    ->label("Top 9 Member")
                    ->relationship('member9', 'name')
                    ->searchable()
                    ->preload(),
                Select::make("member_10_id")
                    ->label("Top 10 Member")
                    ->relationship('member10', 'name')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('week_start_date')
                    ->label('Week')
                    ->date('F j, Y') // Example: May 12, 2025
                    ->sortable(),
                TextColumn::make('member1.name')
                    ->label('Top 1 Member')
                    ->sortable()
                    ->searchable()
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeaderboards::route('/'),
            'create' => Pages\CreateLeaderboard::route('/create'),
            'edit' => Pages\EditLeaderboard::route('/{record}/edit'),
        ];
    }
}
