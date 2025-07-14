<?php

namespace App\Livewire\Base;

use App\Models\Notification as ModelsNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notification extends Component
{

    public $notifications = [];

    public function mount()
    {
       
    }
    public function render()
    {
        return view('livewire.base.notification');
    }
}
