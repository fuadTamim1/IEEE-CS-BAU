<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make()
                ->importer(\App\Filament\Imports\MemberImporter::class)
                // ->sampleExcel([
                //     'data' => [
                //         ['name' => 'John Doe', 'major' => 'Computer Science', 'title' => 'Developer', 'class_of_the_year' => 2023],
                //     ],
                //     'name' => 'sample-members.xlsx',
                // ])
                ->fileRules([
                    'mimes:xlsx,csv', // Restrict to Excel and CSV files
                    'max:1024', // Max file size of 1MB
                ]),
        ];
    }
}
