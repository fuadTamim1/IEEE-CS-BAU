<?php

namespace App\Services;

use App\Mail\ContactMail;
use App\Mail\ContactTicketReplyMail;
use App\Models\ContactTicket;
use App\Models\ContactTicketReply;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class MailService
{
    public function sendContactSubmission(array $data): array
    {
        $ticket = ContactTicket::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'message' => $data['message'],
        ]);

        $mailSent = false;

        try {
            Mail::to('fuad89573@gmail.com')->send(new ContactMail($data));
            $mailSent = true;
        } catch (Throwable $exception) {
            Log::error('Failed to send contact submission notification email.', [
                'ticket_id' => $ticket->id,
                'error' => $exception->getMessage(),
            ]);
        }

        return [
            'ticket' => $ticket,
            'saved' => true,
            'mail_sent' => $mailSent,
        ];
    }

    public function respondToTicket(ContactTicket $ticket, string $message, ?User $responder = null): array
    {
        $reply = ContactTicketReply::create([
            'contact_ticket_id' => $ticket->id,
            'user_id' => $responder?->id,
            'message' => $message,
            'sent_at' => now(),
        ]);

        $mailSent = false;

        try {
            Mail::to($ticket->email)->send(new ContactTicketReplyMail($ticket, $reply));
            $mailSent = true;
        } catch (Throwable $exception) {
            Log::error('Failed to send contact ticket response email.', [
                'ticket_id' => $ticket->id,
                'reply_id' => $reply->id,
                'error' => $exception->getMessage(),
            ]);
        }

        $ticket->update([
            'last_responded_at' => now(),
        ]);

        return [
            'reply' => $reply,
            'mail_sent' => $mailSent,
        ];
    }

    public function send(array $data): bool
    {
        $result = $this->sendContactSubmission($data);

        return (bool) ($result['saved'] ?? false);
    }
}
