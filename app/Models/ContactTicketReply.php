<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactTicketReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_ticket_id',
        'user_id',
        'message',
        'sent_at',
    ];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
        ];
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(ContactTicket::class, 'contact_ticket_id');
    }

    public function responder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
