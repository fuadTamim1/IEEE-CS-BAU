<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'university_id',
        'email',
        'platform_handle',
        'preferred_language',
        'ip_address',
        'user_agent',
        'status',
    ];
}
