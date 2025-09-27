<?php

namespace App\Livewire\Forms;

use App\Models\ModalityBandit;
use App\Models\ParamModuleAttachment;
use App\Models\SetupActivity;
use App\Models\SetupActivityQuestion;
use App\Models\UserActivitySubmission;
use App\Models\UserActivitySubmissionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class UserActivityForm extends Component
{

    public $activity_id;
    public $action;


    public $activity;
    public $total_points;

    public $questions = [];

    public $answers = [];
    public $answer_images = [];


    use WithFileUploads;


    public function mount($activity_id, $action)
    {

        $this->activity_id = decrypt($activity_id);
        $this->action      = decrypt($action);

        $this->activity = SetupActivity::find($this->activity_id);
        $this->total_points = SetupActivityQuestion::where('activity_id', $this->activity_id)->sum('points');

        $this->questions = $this->constructQuestions($this->activity_id);
    }

    public function submit()
    {
        $rules = [];
        foreach ($this->questions as $question) {
            $rules["answers.{$question->id}"] = 'required';
            $rules["answer_images.{$question->id}"] = 'nullable|image|max:11204';
        }
        $messages = [];
        foreach ($this->questions as $question) {
            $messages["answers.{$question->id}.required"] = 'This field is required!';
        }

        $this->validate($rules, $messages);

        try {

            DB::beginTransaction();


            $main = [
                'activity_id'   => $this->activity_id,
                'course_name' => get_course_name($this->activity->course_id),
                'module_name' => get_module_name($this->activity->module_id),
                'activity_name' => $this->activity->title,
                'activity_desc' => $this->activity->description,
                'activity_type' => $this->activity->type,
                'points' => 0,
                'grade' => 0,
                'checked_flag' => in_array($this->activity->type, ['E', 'HO','I']) ? 0 : 1,
                'created_by' => Auth::user()->id
            ];


            $activity_submitted = UserActivitySubmission::create($main);

            if (count($this->answers) > 0) {

                $total_points = 0;
                $grade = 0;

                $number_of_items = count($this->answers);
                $total_possible_points = 0;
                foreach ($this->answers as $key => $value) {
                    $question = SetupActivityQuestion::find($key);
                    $total_possible_points += $question->points;

                    $filename = null;


                    if (
                        $this->activity->type != MULTIPLE_CHOICE
                        and
                        isset($this->answer_images[$key])
                        and
                        $this->answer_images[$key] instanceof \Illuminate\Http\UploadedFile
                    ) {
                        if ($this->answer_images[$key] instanceof \Illuminate\Http\UploadedFile) {
                            $extension = $this->answer_images[$key]->getClientOriginalExtension();
                            $filename  = Str::random(20) . '.' . $extension;
                            $this->answer_images[$key]->storeAs('answer_files', $filename, 'public_path');
                        }
                    }

                    $data = [
                        'activity_submission_id' => $activity_submitted->id,
                        'question' => $question->question,
                        'answer' => $this->answers[$key],
                        'points' => $this->answers[$key] == $question->answer ? $question->points : 0,
                        'max_points' => $question->points,
                        'correct_answer' => $question->answer,
                        'image'          => $filename ?? null
                    ];

                    $total_points += $this->answers[$key] == $question->answer ? $question->points : 0;
                    $grade = ($total_possible_points > 0) ? round(($total_points / $total_possible_points) * 100, 2) : 0;

                    UserActivitySubmissionDetail::create($data);
                }

                UserActivitySubmission::find($activity_submitted->id)->update(
                    [
                        'grade' => $grade,
                        'points' => $total_points,
                    ]
                );
            }


            if (in_array($this->activity->type, [MULTIPLE_CHOICE, IDENTIFICATION])) {
                $modalities = [
                    'a_flag' => 'auditory',
                    'k_flag' => 'kinesthetic',
                    'r_flag' => 'reading_and_writing',
                    'v_flag' => 'visual',
                ];

                foreach ($modalities as $flag => $modality) {
                    if ($this->activity->$flag == 1) {
                        $this->update_bandit(Auth::id(), $modality, $grade);
                    }
                }
            }

            $link = route('user_activity_response', [
                'submission_id' => encrypt($activity_submitted->id),
                'action'      => encrypt(in_array($this->activity->type, [HANDS_ON, ESSAY]) ? ACTION_EDIT : ACTION_VIEW)
            ]);

            $this->send_notification('bx bx-envelope-open', 'Activity Submission', 'Activty Submission has been made by ' . get_user_fullname(Auth::user()->id), $link, $this->activity->created_by);

            DB::commit();

            session()->flash('success', 'Submission Successfull.');

            $this->redirect(route('user_view_course', encrypt($this->activity->course_id)));
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            throw $th;
        }
    }

    #[Title('Answer Activity')]
    public function render()
    {
        return view('livewire.forms.user-activity-form');
    }
}
