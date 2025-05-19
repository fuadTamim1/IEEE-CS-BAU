<?php

namespace App\Filament\Imports;

use App\Models\Member;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Validator;

class MemberImporter extends Importer
{
    protected static ?string $model = Member::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('title')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('major')
                ->requiredMapping()
                ->rules(['required', 'max:' . date('Y')]),
            ImportColumn::make('class_of_the_year')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('image'),
            ImportColumn::make('user_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('contacts'),
        ];
    }

    public function resolveRecord(): ?Member
    {
        // return Member::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Member();
    }
    protected function beforeSave(): void
    {
        // Add custom logic before saving each record
        Validator::make($this->data, [
            'class_of_the_year' => ['required', 'integer', 'max:' . date('Y')],
        ])->validate();
    }
    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your member import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
