<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hero extends Component
{
    public string $title;
    public $background;
    public array $breadcrumbs;
    public function __construct(string $title = "", $background = null, array $breadcrumbs = [])
    {
        $this->title = $title; 
        $this->background = $background; 
        $this->breadcrumbs = $breadcrumbs; 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero');
    }
}
