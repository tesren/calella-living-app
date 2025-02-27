<?php

namespace App\Livewire;

use App\Models\Unit;
use Livewire\Component;

class UnitPage extends Component
{
    public Unit $unit;

    public function mount($name)
    {
        $this->unit = Unit::where('name', $name)->firstOrFail();
        $this->dispatch('id-unidad', id:$this->unit->id);
    }
    
    public function render()
    {
        return view('unit-page');
    }
}
