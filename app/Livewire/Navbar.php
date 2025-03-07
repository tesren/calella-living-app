<?php

namespace App\Livewire;

use App\Models\Section;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class Navbar extends Component
{
    public $sections;
    public $route;
    public $activeSection;

    public function setActiveSection($sectionId)
    {
        $this->activeSection = $sectionId;
    }

    public function mount(){
        $this->sections = Section::all();
        $this->activeSection = $this->sections->first()->id ?? null;
        $this->route = Route::currentRouteName();
    }

    public function render()
    {
        return view('components.navbar');
    }
}
