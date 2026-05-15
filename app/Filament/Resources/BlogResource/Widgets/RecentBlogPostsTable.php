<?php

namespace App\Filament\Resources\BlogResource\Widgets;

use App\Filament\Resources\BlogResource;
use App\Filament\Resources\UserResource;
use App\Models\Blog;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentBlogPostsTable extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Blog::query()
            ->with(['author:id,name', 'category:id,title'])
            ->latest()
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')->label('Title')
                ->url(function ($record): string {
                    return BlogResource::getUrl('edit', ['record' => $record->id]);
                })
                ->limit(20),
            Tables\Columns\TextColumn::make('author.name')
                ->label('Author')
                ->default('Unknown')
                ->url(function ($record): ?string {
                    if (blank($record->author_id)) {
                        return null;
                    }

                    return UserResource::getUrl('edit', ['record' => $record->author_id]);
                })
                ->limit(10),
            Tables\Columns\TextColumn::make('category.title')->label('Category'),
            Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
        ];
    }
}
