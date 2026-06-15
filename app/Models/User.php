<?php

namespace App\Models;

use App\Support\AdminRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

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
        'approval_status',
        'approved_at',
        'password_changed_at',
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
            'approved_at' => 'datetime',
            'password_changed_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check whether the user is a super admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasAnyRole(AdminRoles::superAdminRoles());
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() !== 'admin') {
            return false;
        }

        return $this->hasAnyRole(AdminRoles::adminAccessRoles());
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

    public function isApproved(): bool
    {
        return ($this->approval_status ?? 'approved') === 'approved';
    }

    public function passwordExpired(int $expirationDays): bool
    {
        if ($expirationDays <= 0) {
            return false;
        }

        $changedAt = $this->password_changed_at ?? $this->created_at;
        if (!$changedAt) {
            return false;
        }

        return $changedAt->lt(now()->subDays($expirationDays));
    }
}
