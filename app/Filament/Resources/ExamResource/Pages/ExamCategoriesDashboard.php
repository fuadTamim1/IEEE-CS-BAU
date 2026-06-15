<?php

namespace App\Filament\Resources\ExamResource\Pages;

use App\Filament\Resources\ExamResource;
use App\Models\Exam;
use Filament\Resources\Pages\Page;

class ExamCategoriesDashboard extends Page
{
    protected static string $resource = ExamResource::class;

    protected static ?string $title = 'Exam Categories';

    protected static string $view = 'filament.resources.exam-resource.categories-dashboard';

    public Exam $exam;

    public function mount(): void
    {
        // Filament automatically provides $this->record for resource pages
        $this->exam = Exam::with('categories.tasks')->findOrFail($this->record);
    }
}
