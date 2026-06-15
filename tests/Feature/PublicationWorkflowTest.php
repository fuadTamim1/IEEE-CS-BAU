<?php

use App\Enums\PublicationStatus;
use App\Models\Project;
use App\Models\Workshop;

it('synchronizes project publication_status with publish flag', function () {
    $project = Project::query()->create([
        'title' => 'Workflow Sync Project',
        'description' => 'Publishing workflow project description.',
        'content' => '<p>Project content</p>',
        'is_published' => true,
    ]);

    expect($project->fresh()->publication_status)->toBe(PublicationStatus::PUBLISHED->value);
    expect($project->fresh()->is_published)->toBeTrue();

    $project->update([
        'publication_status' => PublicationStatus::DRAFT->value,
    ]);

    expect($project->fresh()->is_published)->toBeFalse();
});

it('synchronizes workshop publication_status with publish flag', function () {
    $workshop = Workshop::query()->create([
        'name' => 'Workflow Sync Workshop',
        'cover' => 'workshops/test-cover.jpg',
        'publication_status' => PublicationStatus::DRAFT->value,
    ]);

    expect($workshop->fresh()->is_published)->toBeFalse();

    $workshop->update([
        'publication_status' => PublicationStatus::PUBLISHED->value,
    ]);

    expect($workshop->fresh()->is_published)->toBeTrue();
});

it('returns only published records in project and workshop published scopes', function () {
    Project::query()->create([
        'title' => 'Published Project',
        'description' => 'Visible project',
        'content' => '<p>Visible</p>',
        'publication_status' => PublicationStatus::PUBLISHED->value,
    ]);

    Project::query()->create([
        'title' => 'Draft Project',
        'description' => 'Hidden project',
        'content' => '<p>Hidden</p>',
        'publication_status' => PublicationStatus::DRAFT->value,
    ]);

    Workshop::query()->create([
        'name' => 'Published Workshop',
        'cover' => 'workshops/cover-a.jpg',
        'publication_status' => PublicationStatus::PUBLISHED->value,
    ]);

    Workshop::query()->create([
        'name' => 'Draft Workshop',
        'cover' => 'workshops/cover-b.jpg',
        'publication_status' => PublicationStatus::DRAFT->value,
    ]);

    expect(Project::query()->published()->count('*'))->toBe(1);
    expect(Workshop::query()->published()->count('*'))->toBe(1);
});