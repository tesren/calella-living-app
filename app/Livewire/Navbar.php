<?php

namespace App\Livewire;

use App\Models\Section;
use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        $sections = Section::all();

        return view('components.navbar', compact('sections') );
    }
}
