<?php

namespace app\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Footer extends Component{
    public function __construct(public $categories = []) {
        $this->categories = Category::orderBy("created_at")->take(6)->get();
    }

    public function render(): View|Closure|string {
        return view("components.basetheme.footer", ["categories" => $this->categories]);
    }
}