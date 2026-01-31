<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamTaskResource\Pages;
use App\Filament\Resources\ExamTaskResource\RelationManagers;
use App\Models\ExamTask;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamTaskResource extends Resource
{
    protected static ?string $model = ExamTask::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('exam_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('exam_category_id')
                    ->numeric(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('slug')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('points')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('difficulty')
                    ->required(),
                Forms\Components\TextInput::make('submissition_type')
                    ->required(),
                Forms\Components\TextInput::make('auto_flag')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('file_accept')
                    ->required(),
                Forms\Components\Textarea::make('cover_image')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('attachment')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('visible_at')
                    ->required(),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('meta'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('exam_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('exam_category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('points')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('difficulty'),
                Tables\Columns\TextColumn::make('submissition_type'),
                Tables\Columns\TextColumn::make('auto_flag')
                    ->searchable(),
                Tables\Columns\TextColumn::make('visible_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListExamTasks::route('/'),
            'create' => Pages\CreateExamTask::route('/create'),
            'edit' => Pages\EditExamTask::route('/{record}/edit'),
        ];
    }
}
