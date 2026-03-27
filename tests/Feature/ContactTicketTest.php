<?php

use App\Enums\ContactTicketStatus;
use App\Livewire\ContactForm;
use App\Mail\ContactMail;
use App\Mail\ContactTicketReplyMail;
use App\Models\ContactTicket;
use App\Models\User;
use App\Policies\ContactTicketPolicy;
use App\Services\MailService;
use Livewire\Livewire;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

it('stores contact ticket and sends notification email from the livewire form', function () {
    Mail::fake();

    Livewire::test(ContactForm::class)
        ->set('first_name', 'John')
        ->set('last_name', 'Doe')
        ->set('email', 'john@example.com')
        ->set('phone', '1234567890')
        ->set('message', 'Need help with membership details.')
        ->call('submit')
        ->assertHasNoErrors();

    expect(ContactTicket::query()->where([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'status' => ContactTicketStatus::OPEN->value,
    ])->exists())->toBeTrue();

    Mail::assertSent(ContactMail::class);
});

it('allows only super-admin and admin to manage contact tickets', function () {
    Role::findOrCreate('admin');
    Role::findOrCreate('editor');

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $editor = User::factory()->create();
    $editor->assignRole('editor');

    $policy = app(ContactTicketPolicy::class);

    expect($policy->viewAny($admin))->toBeTrue();
    expect($policy->viewAny($editor))->toBeFalse();
});

it('stores reply history and sends response email', function () {
    Mail::fake();

    $ticket = ContactTicket::query()->create([
        'first_name' => 'Jane',
        'last_name' => 'Smith',
        'email' => 'jane@example.com',
        'phone' => null,
        'message' => 'I need support with workshop access.',
    ]);

    $admin = User::factory()->create();

    $result = app(MailService::class)->respondToTicket(
        $ticket,
        'Thanks for contacting us. We have fixed your access issue.',
        $admin,
    );

    expect($result['mail_sent'])->toBeTrue();

    expect($ticket->replies()->where([
        'contact_ticket_id' => $ticket->id,
        'user_id' => $admin->id,
    ])->exists())->toBeTrue();

    Mail::assertSent(ContactTicketReplyMail::class);

    $ticket->refresh();
    expect($ticket->last_responded_at)->not->toBeNull();
});

it('supports open and close ticket lifecycle', function () {
    $ticket = ContactTicket::query()->create([
        'first_name' => 'Ali',
        'last_name' => 'Kareem',
        'email' => 'ali@example.com',
        'phone' => null,
        'message' => 'General inquiry.',
    ]);

    expect($ticket->status)->toBe(ContactTicketStatus::OPEN->value);

    $ticket->update([
        'status' => ContactTicketStatus::CLOSED->value,
        'closed_at' => now(),
    ]);

    $ticket->refresh();

    expect($ticket->status)->toBe(ContactTicketStatus::CLOSED->value);
    expect($ticket->closed_at)->not->toBeNull();

    $ticket->update([
        'status' => ContactTicketStatus::OPEN->value,
        'closed_at' => null,
        'closed_by' => null,
    ]);

    $ticket->refresh();

    expect($ticket->status)->toBe(ContactTicketStatus::OPEN->value);
    expect($ticket->closed_at)->toBeNull();
});
