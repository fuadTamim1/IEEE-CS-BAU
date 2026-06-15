<?php

use App\Models\Event;
use App\Models\Sponsor;

it('keeps sponsor description and legacy descrition synchronized', function () {
    $sponsor = Sponsor::query()->create([
        'name' => 'Schema Sync Partner',
        'description' => 'Normalized sponsor description',
        'website' => 'https://example.com',
        'logo' => 'images/logo.png',
    ]);

    $fresh = $sponsor->fresh();

    expect($fresh->description)->toBe('Normalized sponsor description');
    expect($fresh->getAttribute('descrition'))->toBe('Normalized sponsor description');

    $fresh->update([
        'descrition' => 'Legacy field write still synced',
    ]);

    $again = $fresh->fresh();

    expect($again->description)->toBe('Legacy field write still synced');
    expect($again->getAttribute('descrition'))->toBe('Legacy field write still synced');
});

it('stores and reads event sponsor pivot tier and display_order metadata from both directions', function () {
    $event = Event::factory()->create([
        'title' => 'Pivot Metadata Event',
    ]);

    $sponsorA = Sponsor::query()->create([
        'name' => 'Gold Partner',
        'description' => 'Gold tier sponsor',
        'logo' => 'images/logo.png',
    ]);

    $sponsorB = Sponsor::query()->create([
        'name' => 'Silver Partner',
        'description' => 'Silver tier sponsor',
        'logo' => 'images/logo.png',
    ]);

    $event->sponsors()->attach($sponsorA->id, [
        'tier' => 'gold',
        'display_order' => 2,
    ]);

    $event->sponsors()->attach($sponsorB->id, [
        'tier' => 'silver',
        'display_order' => 1,
    ]);

    $orderedSponsors = $event->fresh()->sponsors;

    expect($orderedSponsors->first()->id)->toBe($sponsorB->id);
    expect($orderedSponsors->first()->pivot->tier)->toBe('silver');
    expect($orderedSponsors->first()->pivot->display_order)->toBe(1);

    $linkedEvent = $sponsorA->fresh()->events->first();

    expect($linkedEvent)->not->toBeNull();
    expect($linkedEvent->pivot->tier)->toBe('gold');
    expect($linkedEvent->pivot->display_order)->toBe(2);
});
