<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class Organizations extends Component
{
    #[Title('Organizations')]
    public function render()
    {
        return view('livewire.pages.organizations');
    }
}
