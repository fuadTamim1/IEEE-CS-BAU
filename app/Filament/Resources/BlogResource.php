<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // First Row: Title (full width)
                TextInput::make('title')
                    ->required()
                    ->columnSpanFull(), // Spans the full width

                // Third Row: Tags (1/2 width) and empty space (1/2 width)
                Forms\Components\Grid::make(2) // 2 columns
                    ->schema([
                        TagsInput::make('tags')
                            ->separator(',')
                            ->columnSpan(1), // Spans 1 column (1/2 width)

                        // Empty space (optional)
                        Forms\Components\Select::make('category_id')
                            ->label('Categroy')
                            ->options(Category::all()->pluck('title', 'id'))
                            ->searchable()
                            ->columnSpan(1), // Spans 1 column (1/2 width)
                    ]),

                FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->imageEditorEmptyFillColor("#FAA41A"),

                // Fourth Row: Content (Rich Editor, full width)
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(), // Spans the full width
                Toggle::make('is_published')
                    ->inline()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("title"),
                TextColumn::make("tags")->badge(),
                TextColumn::make('category.title') // Access the category title via the relationship
                    ->label('Category')
                    ->sortable()
                    ->searchable()->default('No Category'),
                CheckboxColumn::make("is_published"),
                ImageColumn::make("image")
                    ->extraImgAttributes(['loading' => 'lazy']),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
