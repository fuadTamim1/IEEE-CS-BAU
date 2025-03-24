<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Project;
use Livewire\Component;

class PortofiloCards extends Component
{
    public $categories = [];
    public $selected_category = -1; //-1 => all categories by default

    public $projects;

    public function mount() {
        $this->projects = Project::orderBy('created_at')->with('category')->take(30)->get();
        $this->categories = Category::whereHas('projects') // Only categories with projects
        ->select('id', 'title')
        ->get()
        ->toArray();

    }

    public function selectCategory($category_id) {
        $this->selected_category = $category_id;
        if($this->selected_category > -1) {
            $this->projects = Project::orderBy('created_at')->with('category')->where("category_id", $category_id)->take(30)->get();
        }else{
            $this->projects = Project::orderBy('created_at')->with('category')->take(30)->get();
        }
    }

    public function render()
    {
        return view('livewire.portofilo-cards');
    }
}
