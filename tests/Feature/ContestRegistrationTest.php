<?php

use App\Models\ContestRegistration;

it('renders the coming-soon landing page with required sections', function () {
    $response = $this->get(route('coming-soon'));

    $response
        ->assertOk()
        ->assertSeeText('Contest Details')
        ->assertSeeText('Event Agenda')
        ->assertSeeText('Submit Your Registration Payload')
        ->assertSeeText('Frequently Asked Questions')
        ->assertSeeText('Need Help?');
});

it('stores a contest registration from the landing page form', function () {
    $payload = [
        'full_name' => 'Amina Khaled',
        'university_id' => 'BAU-2026-0091',
        'email' => 'amina.khaled@example.edu',
        'platform_handle' => 'amina_cp',
        'preferred_language' => 'C++17',
        'website' => '',
    ];

    $response = $this->from('/coming-soon')->post(route('contest.register'), $payload);

    $response
        ->assertRedirect('/coming-soon')
        ->assertSessionHas('contest_registration_success');

    expect(ContestRegistration::query()->where([
        'full_name' => 'Amina Khaled',
        'university_id' => 'BAU-2026-0091',
        'email' => 'amina.khaled@example.edu',
        'platform_handle' => 'amina_cp',
        'preferred_language' => 'C++17',
        'status' => 'submitted',
    ])->exists())->toBeTrue();
});

it('returns validation errors for missing required fields', function () {
    $response = $this->from('/coming-soon')->post(route('contest.register'), [
        'full_name' => '',
        'university_id' => '',
        'email' => '',
        'platform_handle' => '',
        'preferred_language' => '',
        'website' => '',
    ]);

    $response
        ->assertRedirect('/coming-soon')
        ->assertSessionHasErrors([
            'full_name',
            'university_id',
            'email',
            'preferred_language',
        ]);

    expect(ContestRegistration::query()->count())->toBe(0);
});

it('rejects submission when honeypot is filled', function () {
    $response = $this->from('/coming-soon')->post(route('contest.register'), [
        'full_name' => 'Mohammed Sami',
        'university_id' => 'BAU-2026-0198',
        'email' => 'mohammed.sami@example.edu',
        'platform_handle' => 'msami',
        'preferred_language' => 'Python 3.12',
        'website' => 'https://spam.example',
    ]);

    $response
        ->assertRedirect('/coming-soon')
        ->assertSessionHasErrors(['website']);

    expect(ContestRegistration::query()->count())->toBe(0);
});

it('enforces rate limiting on contest registration route', function () {
    for ($i = 0; $i < 3; $i++) {
        $response = $this->from('/coming-soon')->post(route('contest.register'), [
            'full_name' => 'Student ' . $i,
            'university_id' => 'BAU-2026-THROTTLE-' . $i,
            'email' => 'student' . $i . '@example.edu',
            'platform_handle' => 'handle_' . $i,
            'preferred_language' => 'Java 21',
            'website' => '',
        ]);

        $response->assertRedirect('/coming-soon');
    }

    $blockedResponse = $this->post(route('contest.register'), [
        'full_name' => 'Late Submitter',
        'university_id' => 'BAU-2026-THROTTLE-OVER',
        'email' => 'late.submitter@example.edu',
        'platform_handle' => 'late_handle',
        'preferred_language' => 'Java 21',
        'website' => '',
    ]);

    $blockedResponse->assertStatus(429);
});
