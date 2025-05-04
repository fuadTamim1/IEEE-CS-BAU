<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class leaderboardCard extends Component
{
    public $id;
    public $week; 
    public $image;
    public $publish_at; 
    public $first; 
    public $second; 
    public $thierd; 
    public function __construct($leaderboard)
    {
        $this->id = $leaderboard->id;
        $this->week = $leaderboard->week_start_date->format('W') ?? "1";
        $this->publish_at = $leaderboard->publish_at;
        $this->first = $leaderboard->member1->name ?? "-";
        $this->image = $leaderboard->member1->image ?? "-";
        $this->second = $leaderboard->member2->name ?? "-";
        $this->thierd = $leaderboard->member3->name ?? "-";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.leaderboard-card');
    }
}
