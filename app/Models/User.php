<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Chiiya\FilamentAccessControl\Contracts\AccessControlUser;
use Chiiya\FilamentAccessControl\Enumerators\RoleName;
use Chiiya\FilamentAccessControl\Notifications\TwoFactorCode;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Panel;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'title',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $appends = ['full_name'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check whether the user is a super admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole(RoleName::SUPER_ADMIN);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return $this->name ?? 'Unknown'; // or some default value
    }

    /**
     * Return a name.
     *
     * Needed for compatibility with filament-logger.
     */
    public function getFullNameAttribute(): string
    {
        return $this->attributes['name'] ?? null; // Directly access the underlying attribute
    }
}
