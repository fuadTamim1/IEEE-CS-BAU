<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Enums\BlogStatus;
use App\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['author_id'] = Auth::id();
        $isModerator = Auth::user()?->hasAnyRole(['super-admin', 'admin', 'editor']) ?? false;
        $requiresReview = filter_var(get_setting('require_admin_review_before_publish', true), FILTER_VALIDATE_BOOL);

        if ($isModerator) {
            $status = $data['status'] ?? BlogStatus::PUBLISHED->value;
        } else {
            $status = $requiresReview ? BlogStatus::PENDING_REVIEW->value : BlogStatus::PUBLISHED->value;
            $data['submitted_at'] = now();
            unset($data['rejection_note']);
        }

        $data['status'] = $status;
        $data['is_published'] = $status === BlogStatus::PUBLISHED->value;

        return $data;
    }
}
