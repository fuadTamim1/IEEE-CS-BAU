<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    protected $fillable = [
        'week_start_date',
        'title',
        'publish_at',
        'member_1_id',
        'member_2_id',
        'member_3_id',
        'member_4_id',
        'member_5_id',
        'member_6_id',
        'member_7_id',
        'member_8_id',
        'member_9_id',
        'member_10_id',
    ];
    protected $casts = [
        'week_start_date' => 'date',
    ];
    public function member1()
    {
        return $this->belongsTo(Member::class, 'member_1_id');
    }

    public function member2()
    {
        return $this->belongsTo(Member::class, 'member_2_id');
    }

    public function member3()
    {
        return $this->belongsTo(Member::class, 'member_3_id');
    }

    public function member4()
    {
        return $this->belongsTo(Member::class, 'member_4_id');
    }

    public function member5()
    {
        return $this->belongsTo(Member::class, 'member_5_id');
    }

    public function member6()
    {
        return $this->belongsTo(Member::class, 'member_6_id');
    }

    public function member7()
    {
        return $this->belongsTo(Member::class, 'member_7_id');
    }

    public function member8()
    {
        return $this->belongsTo(Member::class, 'member_8_id');
    }

    public function member9()
    {
        return $this->belongsTo(Member::class, 'member_9_id');
    }

    public function member10()
    {
        return $this->belongsTo(Member::class, 'member_10_id');
    }

    public function scopeLatestWeek($query)
    {
        return $query->orderBy('week_start_date', 'desc')->first();
    }
}
