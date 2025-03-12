<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsor extends Model
{
    protected $fillable = ["name", "description", "website", "logo"];

    public function events(): BelongsToMany {
        return $this->belongsToMany(Event::class, 'event_sponsor');
    }
}
