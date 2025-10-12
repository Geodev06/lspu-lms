<?php

namespace App\Livewire\Pages;

use App\Models\SetupActivity;
use App\Models\UserActivitySubmission;
use App\Models\UserActivitySubmissionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;

class UserActivityResponse extends Component
{

    public $submission_id;
    public $action;
    public $activity;
    public $submission;
    public $submission_details = [];


    public $answers = [];


    public function mount($submission_id, $action)
    {

        $this->submission_id = decrypt($submission_id);
        $this->action      = decrypt($action);

        $this->submission = UserActivitySubmission::find($this->submission_id);
        $this->submission_details = UserActivitySubmissionDetail::where('activity_submission_id', $this->submission_id)->get();

        if ($this->submission_details) {
            foreach ($this->submission_details as $key => $value) {

                $this->answers[$value->id] = $value->points;
            }
        }

        $this->activity = SetupActivity::find($this->submission->activity_id);


    }

    public function submit()
    {
        $rules = [];

        foreach ($this->submission_details as $item) {
            $rules["answers.{$item->id}"] = 'required|numeric|max:' . $item->max_points; // or any other validation rule
        }

        $messages = [];

        foreach ($this->submission_details as $item) {
            $messages["answers.{$item->id}.required"] = 'Points are required!';
            $messages["answers.{$item->id}.numeric"] = 'Points must be a number!';
            $messages["answers.{$item->id}.max"] = 'Points must not be greater than ' . $item->max_points;
        }

        $this->validate($rules, $messages);


        try {

            DB::beginTransaction();


            $total_points = 0;



            foreach ($this->answers as $key => $value) {
                $total_points += floatval($value);

                UserActivitySubmissionDetail::find($key)->update(
                    [
                        'points' => $value
                    ]
                );
            }

            $total_possible_points  = 0;

            foreach ($this->submission_details as $item) {
                $total_possible_points += floatval($item->max_points);
            }

            $grade = ($total_possible_points > 0) ? round(($total_points / $total_possible_points) * 100, 2) : 0;

            UserActivitySubmission::find($this->submission_id)->update(
                [
                    'checked_flag' => 1,
                    'grade' => $grade,
                    'points' => $total_points,

                ]
            );


            if (in_array($this->activity->type, [ESSAY, HANDS_ON])) {
                $modalities = [
                    'a_flag' => 'auditory',
                    'k_flag' => 'kinesthetic',
                    'r_flag' => 'reading_and_writing',
                    'v_flag' => 'visual',
                ];

                foreach ($modalities as $flag => $modality) {
                    if ($this->activity->$flag == 1) {
                        $this->update_bandit($this->submission->created_by, $modality, $grade);
                    }
                }
            }


            $link = route('user_activity_response', [
                'submission_id' => encrypt($this->submission_id),
                'action'      => encrypt(ACTION_VIEW)
            ]);

            $this->send_notification('bx bx-envelope-open', 'Finished Activity', 'Your Activity has been checked by' . get_user_fullname(Auth::user()->id), $link, $this->submission->created_by);

            DB::commit();

            session()->flash('success', 'Record Updated Successfull.');

            $this->redirect(request()->header('Referer'));
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            throw $th;
        }
    }

    #[Title('Activity')]

    public function render()
    {
        return view('livewire.pages.user-activity-response');
    }
}
