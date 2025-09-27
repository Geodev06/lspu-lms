<?php

namespace App\Livewire\Base;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Nav extends Component
{

    public $notifications = [];

    public function mount()
    {
        $this->notifications = Notification::where(
            [
                'receiver_id' => Auth::user()->id,
                'seen_flag'   => 0
            ]
        )->orderBy('created_at', 'desc')->get();
    }

    public function update_status($id)
    {
        Notification::find($id)->update(
            ['seen_flag' => 1]
        );
    }

    public function render()
    {
        return view('livewire.base.nav');
    }
}
