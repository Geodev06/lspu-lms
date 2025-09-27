<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class NotificationPage extends Component
{
    #[Title('Notifications')]

    public function render()
    {
        return view('livewire.pages.notification-page');
    }
}
