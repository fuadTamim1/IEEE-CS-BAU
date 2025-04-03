<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        $yeaars = [
            "2000" => 2000,
            "2001" => 2001,
            "2002" => 2002,
            "2003" => 2003,
            "2004" => 2004,
            "2005" => 2005,
            "2006" => 2006,
            "2007" => 2007,
            "2008" => 2008,
            "2009" => 2009,
            "2010" => 2010,
            "2011" => 2011,
            "2012" => 2012,
            "2013" => 2013,
            "2014" => 2014,
            "2015" => 2015,
            "2016" => 2016,
            "2017" => 2017,
            "2018" => 2018,
            "2019" => 2019,
            "2020" => 2020,
            "2021" => 2021,
            "2022" => 2022,
            "2023" => 2023,
            "2024" => 2024,
            "2025" => 2025,
            "2026" => 2026,
            "2027" => 2027,
            "2028" => 2028,
            "2029" => 2029,
        ];

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('title')
                    ->options([
                        "chairperson" => "chairperson",
                        "PR" => "PR",
                        "MD" => "MD",
                        "Treauser" => "Treauser",
                        "Member" => "Member"
                    ]),
                Forms\Components\TextInput::make('major')
                    ->required()
                    ->maxLength(255),
                Select::make('class_of_the_year')
                    ->options($yeaars)
                    ->searchable(),
                Repeater::make('contacts')
                    ->schema([
                        Select::make('key')
                            ->options([
                                'facebook' => 'Facebook',
                                'linkedin' => 'LinkedIn',
                                'instagram' => 'Instagram',
                                'twitter' => 'Twitter',
                                'youtube' => 'YouTube',
                                'website' => 'Website',
                                // add more platforms as needed
                            ])
                            ->required()
                            ->columnSpan(1),

                        TextInput::make('value')
                            ->label('URL')
                            ->url()
                            ->required()
                            ->columnSpan(3),
                    ])
                    ->columns(4)
                    ->columnSpanFull()
                    ->default([])
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                        return collect($data)->pluck('value', 'key')->toArray();
                    })
                    ->mutateRelationshipDataBeforeSaveUsing(function (array $data): array {
                        return collect($data)->pluck('value', 'key')->toArray();
                    }),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->label("Personal Photo")
                    ->default("pixel.jpg"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('major')
                    ->searchable(),
                Tables\Columns\TextColumn::make('class_of_the_year')
                    ->sortable(),
                IconColumn::make('hasImage')
                    ->label('Has Image')
                    ->boolean()
                    ->getStateUsing(function ($record) {
                        // Check if the "image" field is not empty
                        return !empty($record->image);
                    })->sortable(),
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
