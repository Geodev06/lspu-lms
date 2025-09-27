<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class UserActivity extends Component
{
    #[Title('Activities')]

    public function render()
    {
        return view('livewire.pages.user-activity');
    }
}
