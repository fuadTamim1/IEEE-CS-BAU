<?php

namespace App\Models;

use App\Enums\ContactTicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'message',
        'status',
        'closed_at',
        'closed_by',
        'last_responded_at',
    ];

    protected function casts(): array
    {
        return [
            'closed_at' => 'datetime',
            'last_responded_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ContactTicket $ticket): void {
            if (blank($ticket->status)) {
                $ticket->status = ContactTicketStatus::OPEN->value;
            }
        });
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ContactTicketReply::class)->latest();
    }

    public function closedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'closed_by');
    }
}
