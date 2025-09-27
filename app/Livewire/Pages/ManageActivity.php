<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class ManageActivity extends Component
{
    #[Title('Manage Activity')]

    public function render()
    {
        return view('livewire.pages.manage-activity');
    }
}
