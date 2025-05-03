<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\View\Component;

class TeamMemberCard extends Component
{
    public $contacts;
    /**
     * Create a new component instance.
     */
    public function __construct(public $name, public $role, public $links, public $image = null)
    {
        if ($links)
            $this->contacts = $links->getArrayCopy();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.team-member-card');
    }
}
