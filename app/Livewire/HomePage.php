<?php

namespace App\Livewire;

use App\Models\Unit;
use App\Models\Section;
use Livewire\Component;
use Livewire\Attributes\Url;

class HomePage extends Component
{
    public $selected_unit;
    public $sections;

    #[Url]
    public ?string $activeSection;
    
    public function setActiveSection($sectionId)
    {
        $this->activeSection = $sectionId;
    }

    public function updateUnit($unitID)
    {
        $this->selected_unit = null; // Limpiar antes de asignar para forzar renderizado
        $this->selected_unit = Unit::find($unitID);
        $this->activeSection = $this->selected_unit->section_id;

    }

    public function mount(){
        $this->sections = Section::all();
        $this->activeSection =  request()->query('activeSection') ?? $this->sections->first()->id ?? null;
    }

    public function render()
    {
        return view('home-page');
    }
}
