<?php

namespace App\Livewire\Forms;

use App\Models\SetupActivity;
use App\Models\SetupActivityQuestion;
use App\Models\SetupQuestionChoice;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Symfony\Component\Console\Question\ChoiceQuestion;

class SetupQuestionForm extends Component
{

    use WithFileUploads;
    public $id;
    public $action;

    public $activity;
    public $activity_id;


    public $record;

    public $question;
    public $answer;
    public $points;
    public $image;
    public $current_image;


    public $choice_a, $choice_b, $choice_c, $choice_d;
    public $image_a, $image_b, $image_c, $image_d;



    function areChoicesUnique($a, $b, $c, $d)
    {
        $choices = [$a, $b, $c, $d];
        return count(array_unique($choices)) === 4;
    }



    public function mount($activity_id = null, $id = null, $action = null)
    {

        $this->activity_id = decrypt($activity_id);

        $this->activity = SetupActivity::find($this->activity_id);

        if ($id) {

            $this->id = decrypt($id);
            $this->action = decrypt($action);
            $this->record = SetupActivityQuestion::find($this->id);

            $this->question = $this->record->question;
            $this->points = $this->record->points;
            $this->answer = $this->record->answer;
            $this->current_image = $this->record->image;



            if ($this->activity->type == MULTIPLE_CHOICE) {
                $this->choice_a = SetupQuestionChoice::where('question_id', $this->id)->where('key', 'A')->first()['choice'] ?? null;
                $this->choice_b = SetupQuestionChoice::where('question_id', $this->id)->where('key', 'B')->first()['choice'] ?? null;
                $this->choice_c = SetupQuestionChoice::where('question_id', $this->id)->where('key', 'C')->first()['choice'] ?? null;
                $this->choice_d = SetupQuestionChoice::where('question_id', $this->id)->where('key', 'D')->first()['choice'] ?? null;

                $this->image_a = SetupQuestionChoice::where('question_id', $this->id)->where('key', 'A')->first()['image'] ?? null;
                $this->image_b = SetupQuestionChoice::where('question_id', $this->id)->where('key', 'B')->first()['image'] ?? null;
                $this->image_c = SetupQuestionChoice::where('question_id', $this->id)->where('key', 'C')->first()['image'] ?? null;
                $this->image_d = SetupQuestionChoice::where('question_id', $this->id)->where('key', 'D')->first()['image'] ?? null;
            }
        }
    }

    public function updated($property)
    {
        if ($property === 'image_a') {
            $this->handleFileUpload($property, 'A');
        }

        if ($property === 'image_b') {
            $this->handleFileUpload($property, 'B');
        }

        if ($property === 'image_c') {
            $this->handleFileUpload($property, 'C');
        }

        if ($property === 'image_d') {
            $this->handleFileUpload($property, 'D');
        }
    }


    protected function handleFileUpload($property, $key = null)
    {
        $file = $this->{$property};

        if ($file instanceof \Illuminate\Http\UploadedFile) {
            $extension = $file->getClientOriginalExtension();
            $filename  = Str::random(20) . '.' . $extension;
            $file->storeAs('question_attachments', $filename, 'public_path');
        }

        if ($file and $this->id) {
            $this->validateOnly($property, [
                $property => 'image|max:11024', // ~11MB max
            ]);

            SetupQuestionChoice::where('question_id', $this->id)
                ->where('key', $key)
                ->update(['image' => $filename]);
            $this->{$property} = $filename;
        }
    }



    #[On('update_textarea_value')]
    public function update_description_value($data)
    {
        $this->question = $data;
    }

    public function process()
    {
        $this->check_action();

        $rules = [

            'question' => 'required|string|max:20000',
            'answer' => 'nullable|max:20000',
            'image' => 'nullable|image|max:10120',
            'points' => ['required', 'regex:/^\d+(\.\d)?$/', 'max:50', 'numeric'],
            'choice_a' => 'nullable',
            'choice_b' => 'nullable',
            'choice_c' => 'nullable',
            'choice_d' => 'nullable',

        ];

        if ($this->activity->type == MULTIPLE_CHOICE) {
            $rules['choice_a'] = 'required|string|max:245';
            $rules['choice_b'] = 'required|string|max:245';
            $rules['choice_c'] = 'required|string|max:245';
            $rules['choice_d'] = 'required|string|max:245';
            $rules['answer']   = 'required|string|max:20000';
        }



        $validated_data = $this->validate($rules);


        if ($this->activity->type == MULTIPLE_CHOICE) {
            if (!$this->areChoicesUnique(
                $this->choice_a,
                $this->choice_b,
                $this->choice_c,
                $this->choice_d,

            )) {
                session()->flash('error', 'All choices must be unique.');
                return;
            }
        }

        try {

            DB::beginTransaction();


            $data = [
                'question'            => $this->question,
                'answer'              => $this->answer,
                'activity_id'         => $this->activity_id,
                'points'              => $this->points
            ];


            if ($this->image instanceof \Illuminate\Http\UploadedFile) {
                $extension = $this->image->getClientOriginalExtension();
                $filename  = Str::random(20) . '.' . $extension;
                $this->image->storeAs('question_attachments', $filename, 'public_path');
                $data['image'] = $filename; // only set if uploaded
            }



            if ($this->id) {


                SetupActivityQuestion::find($this->id)->update($data);

                if ($this->activity->type == MULTIPLE_CHOICE) {

                    // SetupQuestionChoice::where('question_id', $this->id)->delete();

                    SetupQuestionChoice::where('question_id', $this->id)
                        ->where('key', 'A')
                        ->update(['choice' => $this->choice_a]);
                    SetupQuestionChoice::where('question_id', $this->id)
                        ->where('key', 'B')
                        ->update(['choice' => $this->choice_b]);

                    SetupQuestionChoice::where('question_id', $this->id)
                        ->where('key', 'C')
                        ->update(['choice' => $this->choice_c]);

                    SetupQuestionChoice::where('question_id', $this->id)
                        ->where('key', 'D')
                        ->update(['choice' => $this->choice_d]);

                    // $this->insert_choice($this->id, 'A', $this->choice_a);
                    // $this->insert_choice($this->id, 'B', $this->choice_b);
                    // $this->insert_choice($this->id, 'C', $this->choice_c);
                    // $this->insert_choice($this->id, 'D', $this->choice_d);
                }

                session()->flash('success', 'Question has been successfully updated.');
            } else {

                $question = SetupActivityQuestion::create($data);

                if ($this->activity->type == MULTIPLE_CHOICE) {
                    $this->insert_choice($question->id, 'A', $this->choice_a);
                    $this->insert_choice($question->id, 'B', $this->choice_b);
                    $this->insert_choice($question->id, 'C', $this->choice_c);
                    $this->insert_choice($question->id, 'D', $this->choice_d);
                }

                session()->flash('success', 'Question has been created.');
            }

            $this->redirect(route('activity_form', [
                'id' => encrypt($this->activity_id),
                'action' => encrypt(ACTION_MANAGE)
            ]));

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollBack();
        }
    }

    #[Title('Activty Question Form')]

    public function render()
    {
        return view('livewire.forms.setup-question-form');
    }

    public function delete()
    {
        try {
            //code...\
            DB::beginTransaction();

            $question = SetupActivityQuestion::find($this->id);

            if ($this->activity->type == MULTIPLE_CHOICE) {
                SetupQuestionChoice::where('question_id', $this->id)->delete();
            }

            if ($question->image) {
                $filePath = public_path('uploads/question_attachments/' . $question->image);

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $question->delete();
            session()->flash('success', 'Question has been Deleted.');

            $this->redirect(route('activity_form', [
                'id' => encrypt($this->activity_id),
                'action' => encrypt(ACTION_MANAGE)
            ]));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }
    }

    public function insert_choice($question_id, $key, $choice_value)
    {
        try {
            //code...\
            DB::beginTransaction();

            SetupQuestionChoice::create([
                'question_id' => $question_id,
                'choice' => $choice_value,
                'key' => $key
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }
    }
}
