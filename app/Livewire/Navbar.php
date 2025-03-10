<?php

namespace App\Livewire;

use App\Models\Unit;
use App\Models\Section;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\Url;

class Navbar extends Component
{
    public $sections;
    public $route;
    public $unit_name = '101';

    #[Url]
    public ?string $activeSection;

    #[On('id-unidad')] 
    public function updateUnit($id)
    {
        $unit = Unit::findOrFail($id);
        $this->unit_name = $unit->name;
    }

    public function setActiveSection($sectionId)
    {
        $this->activeSection = $sectionId;
    }

    public function mount(){
        $this->sections = Section::all();
        $this->activeSection =  request()->query('activeSection') ?? $this->sections->first()->id ?? null;
        $this->route = Route::currentRouteName();
    }

    public function render()
    {
        return view('components.navbar');
    }
}
