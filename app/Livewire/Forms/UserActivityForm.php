<?php

namespace App\Livewire\Forms;

use App\Models\SetupActivity;
use App\Models\SetupActivityQuestion;
use Livewire\Attributes\Title;
use Livewire\Component;

class UserActivityForm extends Component
{

    public $activity_id;
    public $action;


    public $activity;
    public $total_points;



    public function mount($activity_id, $action)
    {

        $this->activity_id = decrypt($activity_id);
        $this->action      = decrypt($action);

        $this->activity = SetupActivity::find($this->activity_id);
        $this->total_points = SetupActivityQuestion::where('activity_id', $this->activity_id)->sum('points');


    }

    #[Title('Answer Activity')]
    public function render()
    {
        return view('livewire.forms.user-activity-form');
    }
}
