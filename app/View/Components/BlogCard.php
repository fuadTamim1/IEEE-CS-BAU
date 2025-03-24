<?php

namespace App\View\Components;

use App\Models\Blog;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogCard extends Component
{
    public Blog $blog;
    public function __construct($blog) {
       $this->blog = $blog;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.blog-card');
    }
}
