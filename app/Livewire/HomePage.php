<?php

namespace App\Livewire;

use App\Models\Unit;
use App\Models\Section;
use Livewire\Component;

class HomePage extends Component
{
    public $selected_unit;

    public function updateUnit($unitID)
    {
        $this->selected_unit = null; // Limpiar antes de asignar para forzar renderizado
        $this->selected_unit = Unit::find($unitID);

    }

    public function render()
    {

        $sections = Section::all();

        return view('home-page', compact('sections') );
    }
}
