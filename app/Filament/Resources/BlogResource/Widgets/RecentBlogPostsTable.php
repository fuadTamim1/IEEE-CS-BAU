<?php

namespace App\Filament\Resources\BlogResource\Widgets;

use App\Models\Blog;
use App\Models\User;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentBlogPostsTable extends BaseWidget
{
    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Blog::query()->latest()->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')->label('Title')
                ->url(function ($record): string {
                    return "/admin/blogs/" . $record->id . "/edit";
                })
                ->limit(20),
            Tables\Columns\TextColumn::make("Author")
                ->getStateUsing(function ($record) {
                    return User::find($record->author_id)->name ?? "unkown";
                })
                ->url(function ($record): string {
                    return "/admin/users/" . $record->author_id . "/edit";
                })
                ->limit(10),
            Tables\Columns\TextColumn::make('category.title')->label('Category'),
            Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
        ];
    }
}
