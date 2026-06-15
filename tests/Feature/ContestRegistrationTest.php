<?php

use App\Models\Bcpc\BcpcRegistration;

it('renders the bcpc landing page with required sections', function () {
    $response = $this->get(route('bcpc'));

    $response
        ->assertOk()
        ->assertSeeText('BCPC Newbie Teams Cup')
        ->assertSeeText('Competition Details')
        ->assertSeeText('Certificates and Sponsors')
        ->assertSeeText('Team Registration');
});

it('stores a bcpc team registration from the modal form', function () {
    $payload = [
        'team_name' => 'Stack Smashers',
        'captain_name' => 'Amina Khaled',
        'captain_university_id' => 'BAU-2026-0091',
        'captain_email' => 'amina.khaled@example.edu',
        'team_size' => 3,
        'member_two_name' => 'Lina Ahmad',
        'member_three_name' => 'Yara Fares',
        'website' => '',
    ];

    $response = $this->from('/bcpc')->post(route('bcpc.register'), $payload);

    $response
        ->assertRedirect('/bcpc')
        ->assertSessionHas('contest_registration_success');

    expect(BcpcRegistration::query()->where([
        'team_name' => 'Stack Smashers',
        'captain_name' => 'Amina Khaled',
        'captain_university_id' => 'BAU-2026-0091',
        'captain_email' => 'amina.khaled@example.edu',
        'team_size' => 3,
        'member_two_name' => 'Lina Ahmad',
        'member_three_name' => 'Yara Fares',
        'full_name' => 'Amina Khaled',
        'university_id' => 'BAU-2026-0091',
        'email' => 'amina.khaled@example.edu',
        'preferred_language' => 'N/A',
        'status' => 'submitted',
    ])->exists())->toBeTrue();
});

it('returns validation errors for missing required fields', function () {
    $response = $this->from('/bcpc')->post(route('bcpc.register'), [
        'team_name' => '',
        'captain_name' => '',
        'captain_university_id' => '',
        'captain_email' => '',
        'team_size' => '',
        'member_two_name' => '',
        'member_three_name' => '',
        'website' => '',
    ]);

    $response
        ->assertRedirect('/bcpc')
        ->assertSessionHasErrors([
            'team_name',
            'captain_name',
            'captain_university_id',
            'captain_email',
            'team_size',
            'member_two_name',
        ]);

    expect(BcpcRegistration::query()->count())->toBe(0);
});

it('rejects submission when honeypot is filled', function () {
    $response = $this->from('/bcpc')->post(route('bcpc.register'), [
        'team_name' => 'Null Pointers',
        'captain_name' => 'Mohammed Sami',
        'captain_university_id' => 'BAU-2026-0198',
        'captain_email' => 'mohammed.sami@example.edu',
        'team_size' => 2,
        'member_two_name' => 'Sara Nabil',
        'member_three_name' => '',
        'website' => 'https://spam.example',
    ]);

    $response
        ->assertRedirect('/bcpc')
        ->assertSessionHasErrors(['website']);

    expect(BcpcRegistration::query()->count())->toBe(0);
});

it('enforces rate limiting on bcpc registration route', function () {
    for ($i = 0; $i < 3; $i++) {
        $response = $this->from('/bcpc')->post(route('bcpc.register'), [
            'team_name' => 'Rate Team ' . $i,
            'captain_name' => 'Student ' . $i,
            'captain_university_id' => 'BAU-2026-THROTTLE-' . $i,
            'captain_email' => 'student' . $i . '@example.edu',
            'team_size' => 2,
            'member_two_name' => 'Member Two ' . $i,
            'member_three_name' => '',
            'website' => '',
        ]);

        $response->assertRedirect('/bcpc');
    }

    $blockedResponse = $this->post(route('bcpc.register'), [
        'team_name' => 'Late Team',
        'captain_name' => 'Late Submitter',
        'captain_university_id' => 'BAU-2026-THROTTLE-OVER',
        'captain_email' => 'late.submitter@example.edu',
        'team_size' => 2,
        'member_two_name' => 'Late Member',
        'member_three_name' => '',
        'website' => '',
    ]);

    $blockedResponse->assertStatus(429);
});
