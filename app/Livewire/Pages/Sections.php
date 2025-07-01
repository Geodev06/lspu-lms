<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class Sections extends Component
{
    #[Title('Sections')]

    public function render()
    {
        return view('livewire.pages.sections');
    }
}
