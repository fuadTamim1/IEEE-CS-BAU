<?php

namespace App\Filament\Exports;

use App\Models\Member;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class MemberExporter extends Exporter
{
    protected static ?string $model = Member::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name'),

            ExportColumn::make('title'),

            ExportColumn::make('major'),

            ExportColumn::make('class_of_the_year'),

            ExportColumn::make('image'),

            ExportColumn::make('user_id'),

            ExportColumn::make('contacts')
                ->formatStateUsing(function ($state) {
                    // If it's empty or not iterable, return a blank string
                    if (empty($state) || ! is_iterable($state)) {
                        return '';
                    }

                    // Loop through the array, format 'key: value', and join them with a separator
                    return collect($state)->map(function ($contact) {
                        $key = ucfirst($contact['key'] ?? '');
                        $value = $contact['value'] ?? '';

                        return "{$key}: {$value}";
                    })->implode(' | ');
                }),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your member export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
