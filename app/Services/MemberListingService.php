<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class MemberListingService
{
    public const TAB_COMMITTEE = 'committee';
    public const TAB_MEMBERS = 'members';

    public function normalizeTab(?string $tab): string
    {
        return in_array($tab, [self::TAB_COMMITTEE, self::TAB_MEMBERS], true)
            ? $tab
            : self::TAB_COMMITTEE;
    }

    public function paginateByTab(string $tab, int $perPage, int $page = 1, string $pageName = 'team_page'): LengthAwarePaginator
    {
        $normalizedTab = $this->normalizeTab($tab);

        return $this->buildQuery($normalizedTab)
            ->paginate($perPage, ['*'], $pageName, $page);
    }

    private function buildQuery(string $tab): Builder
    {
        $query = Member::query()
            ->select(['id', 'name', 'title', 'contacts', 'image', 'order'])
            ->orderByDesc('order')
            ->orderBy('name');

        if ($tab === self::TAB_MEMBERS) {
            return $query->whereRaw('LOWER(COALESCE(title, "")) = ?', ['member']);
        }

        return $query->whereRaw('LOWER(COALESCE(title, "")) <> ?', ['member']);
    }
}
