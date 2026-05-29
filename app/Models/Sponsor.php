<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Schema;

class Sponsor extends Model
{
    use HasFactory;

    protected static ?bool $supportsDescriptionColumn = null;

    protected $fillable = ["name", "description", "descrition", "website", "logo"];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_sponsor')
            ->withPivot(['tier', 'display_order'])
            ->withTimestamps()
            ->orderByPivot('display_order');
    }

    public function getDescriptionAttribute($value): string
    {
        return (string) ($value ?? ($this->attributes['descrition'] ?? ''));
    }

    public function setDescriptionAttribute($value): void
    {
        $normalized = (string) ($value ?? '');

        $this->attributes['descrition'] = $normalized;

        if (self::supportsDescriptionColumn()) {
            $this->attributes['description'] = $normalized;
        }
    }

    public function setDescritionAttribute($value): void
    {
        $this->setDescriptionAttribute($value);
    }

    protected static function supportsDescriptionColumn(): bool
    {
        if (self::$supportsDescriptionColumn !== null) {
            return self::$supportsDescriptionColumn;
        }

        try {
            self::$supportsDescriptionColumn = Schema::hasColumn('sponsors', 'description');
        } catch (\Throwable) {
            self::$supportsDescriptionColumn = false;
        }

        return self::$supportsDescriptionColumn;
    }
}
