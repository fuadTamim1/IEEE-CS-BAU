<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use App\Support\AdminRoles;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make("title")->label("Title"),
                Textarea::make('description')->label('Description')->default("Exam Details"),
                Forms\Components\FileUpload::make('cover_image')
                    ->image()
                    ->required(),
                Checkbox::make("is_published")->label("Published")->default(1),
                
                // The Action Button
                Actions::make([
                    Action::make('generateCategories')
                        ->label('Define Categories')
                        ->icon('heroicon-m-plus')
                        ->button()
                        ->slideOver()
                        ->modalHeading('Define Exam Categories')
                        ->form(static::getCategoryGenerationFormSchema())
                        ->action(function (array $data, Set $set) {
                            static::handleCategoryGeneration($data, $set);
                        })
                ])
                    ->columnSpanFull()
                    ->extraAttributes(['class' => 'py-4']),

                // The Repeater field that will show the final list
                Repeater::make('exam_categories')
                    ->label('Final Exam Categories')
                    ->schema([
                        TextInput::make('category_name')
                            ->label('Category Name')
                            ->required(),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->disabled(), // Optional: disable or hide
                    ])
                    ->columns(2)
                    ->defaultItems(0) // Start empty
                    ->addActionLabel('Add Manual Category'), // You can still manually add

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("title"),
                IconColumn::make("is_published")->label("Published")
                    ->boolean()
                    ->sortable()
                    ->trueColor('success')
                    ->falseColor('danger'),
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

    protected static function getCategoryGenerationFormSchema(): array
    {
        return [
            Repeater::make('temp_categories')
                ->label('Category Definitions')
                ->schema([
                    TextInput::make('name')
                        ->label('Source Category Name')
                        ->required(),
                    TextInput::make('prefix')
                        ->label('Prefix for New Category')
                        ->placeholder('e.g., "Level 1"')
                        ->default('')
                        ->nullable(),
                ])
                ->defaultItems(1)
                ->columns(2)
                ->required(),
        ];
    }

    // In app/Filament/Resources/ExamResource.php (within the class)

    protected static function handleCategoryGeneration(array $data, Set $set): void
    {
        $newCategories = [];

        // Loop through the data submitted from the modal's repeater
        foreach ($data['temp_categories'] as $category) {
            $name = trim($category['name']);
            $prefix = trim($category['prefix']);

            // 1. Create the new category name
            $newCategoryName = $prefix ? "{$prefix} - {$name}" : $name;

            // 2. Format the data for the main form's repeater
            $newCategories[] = [
                'category_name' => $newCategoryName,
                'slug' => Str::slug($newCategoryName),
            ];
        }

        // Use $set to replace the existing content of the 'exam_categories' repeater
        $set('exam_categories', $newCategories);

        // You can optionally show a notification
        \Filament\Notifications\Notification::make()
            ->title('Categories Generated')
            ->body('The categories have been successfully defined and added to the list.')
            ->success()
            ->send();
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
            'dashboard' => Pages\ExamCategoriesDashboard::route('/dashboard'),
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
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