<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Users extends Component
{
    #[Title('Users')]
    public function render()
    {
        return view('livewire.pages.users');
    }
}
