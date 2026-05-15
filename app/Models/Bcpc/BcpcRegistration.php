<?php

namespace App\Models\Bcpc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BcpcRegistration extends Model
{
    use HasFactory;

    protected $table = 'contest_registrations';

    protected $fillable = [
        'team_name',
        'captain_name',
        'captain_university_id',
        'captain_email',
        'team_size',
        'member_two_name',
        'member_three_name',
        'full_name',
        'university_id',
        'email',
        'platform_handle',
        'preferred_language',
        'ip_address',
        'user_agent',
        'status',
    ];

    protected $casts = [
        'team_size' => 'integer',
    ];

    public static function statusOptions(): array
    {
        return [
            'submitted' => 'Submitted',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'disqualified' => 'Disqualified',
        ];
    }
}
