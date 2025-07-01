<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{

    #[Title('Dashboard')]
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.pages.dashboard');
    }
}
