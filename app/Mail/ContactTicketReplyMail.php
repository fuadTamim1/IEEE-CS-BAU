<?php

namespace App\Mail;

use App\Models\ContactTicket;
use App\Models\ContactTicketReply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactTicketReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactTicket $ticket,
        public ContactTicketReply $reply
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Re: Your contact request to IEEE CS',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.contact-ticket-reply',
        );
    }
}
