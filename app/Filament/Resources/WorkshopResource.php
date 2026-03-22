<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkshopResource\Pages;
use App\Models\Workshop;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;

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
            Toggle::make('is_published')->default(true),
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
                Tables\Columns\TextColumn::make('start_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('end_at')->dateTime()->sortable(),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Published'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')->label('Published'),
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
            'index' => Pages\ListWorkshops::route('/'),
            'create' => Pages\CreateWorkshop::route('/create'),
            'edit' => Pages\EditWorkshop::route('/{record}/edit'),
        ];
    }
}
