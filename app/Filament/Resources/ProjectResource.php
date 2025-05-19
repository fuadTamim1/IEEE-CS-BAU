<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Filament\Support\Enums\FontWeight;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Project Information')
                    ->description('Basic details about the project.')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('description')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TagsInput::make('tags')->separator(','),

                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'title'),
                    ]),

                Forms\Components\Section::make('Project Details') // 🆕 New Sub-header
                    ->description('Information about the project creator, location, cost, and timeframe.')
                    ->collapsible() // Makes it collapsible for better UI
                    ->schema([
                        Forms\Components\TagsInput::make('created_by')
                            ->label('Created By')
                            ->placeholder('Enter members name')
                            ->separator()
                            ->nullable(),

                        Forms\Components\TextInput::make('cost')
                            ->label('Project Cost')
                            ->numeric()
                            ->prefix('$')
                            ->nullable()
                            ->step(0.01)
                            ->placeholder('Enter cost in USD'),

                        Forms\Components\TextInput::make('location')
                            ->label('Project Location')
                            ->nullable()
                            ->placeholder('Enter location'),

                        Forms\Components\DatePicker::make('timeframe')
                            ->label('Timeframe')
                            ->nullable()
                            ->native(false)
                            ->placeholder('Select project timeframe'),

                        Forms\Components\TextInput::make('link')
                            ->label('Project Link')
                            ->nullable()
                            ->placeholder('Enter Link: https://github.com/r/something'),
                    ]),

                Forms\Components\Section::make('Content & Media')
                    ->description('Project description, images, and attachments.')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('projects')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull()
                            ->preserveFilenames()
                            ->disk('public')
                            ->hiddenOn(['edit']),
                    ]),

                Forms\Components\Toggle::make('is_published')
                    ->label('Publish Project')
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->size(40)
                    ->circular()
                    ->defaultImageUrl(url('/images/default-project.png'))
                    ->visibility('public'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->description(fn(Project $record): string => Str::limit($record->description, 50)),

                Tables\Columns\TextColumn::make('category.title')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Design' => 'info',
                        'Development' => 'success',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tags')
                    ->badge()
                    ->separator(',')
                    ->searchable()
                    ->color('primary'),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->sortable()
                    ->label('Published')
                    ->trueColor('success')
                    ->falseColor('danger'),

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
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'title'),

                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Published Status')
                    ->trueLabel('Only Published')
                    ->falseLabel('Only Unpublished')
                    ->nullable(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('publish')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->action(fn(Project $record) => $record->update(['is_published' => true]))
                        ->hidden(fn(Project $record): bool => $record->is_published),
                    Tables\Actions\Action::make('unpublish')
                        ->icon('heroicon-m-x-circle')
                        ->color('danger')
                        ->action(fn(Project $record) => $record->update(['is_published' => false]))
                        ->hidden(fn(Project $record): bool => !$record->is_published),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('publish')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->action(fn(Collection $records) => $records->each->update(['is_published' => true])),
                    Tables\Actions\BulkAction::make('unpublish')
                        ->icon('heroicon-m-x-circle')
                        ->color('danger')
                        ->action(fn(Collection $records) => $records->each->update(['is_published' => false])),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('No projects yet')
            ->emptyStateDescription('Create your first project by clicking the button below')
            ->emptyStateIcon('heroicon-o-document')
            ->deferLoading()
            ->persistSearchInSession()
            ->persistColumnSearchesInSession();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
