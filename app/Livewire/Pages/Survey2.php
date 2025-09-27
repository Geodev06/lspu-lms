<?php

namespace App\Livewire\Pages;

use App\Models\ModalityStat;
use App\Models\SurveyModel2;
use App\Models\User;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;

class Survey2 extends Component
{

    // vISUAL
    public $question_1;
    public $question_2;
    public $question_3;
    public $question_4;
    public $question_5;
    // AUDITORY
    public $question_6;
    public $question_7;
    public $question_8;
    public $question_9;
    public $question_10;
    // READING
    public $question_11;
    public $question_12;
    public $question_13;
    public $question_14;
    public $question_15;
    // KINESTHETIC
    public $question_16;
    public $question_17;
    public $question_18;
    public $question_19;
    public $question_20;


    public function mount() {}

    public function submit()
    {

        if (Auth::user()->first_login == 0) {
            sleep(3);
            session()->flash('error', 'Survey Expires, Redirecting to dashboard in a moment.');
            $this->redirect(route('dashboard'));
        }


        $data = $this->validate([
            'question_1'  => 'required',
            'question_2'  => 'required',
            'question_3'  => 'required',
            'question_4'  => 'required',
            'question_5'  => 'required',
            'question_6'  => 'required',
            'question_7'  => 'required',
            'question_8'  => 'required',
            'question_9'  => 'required',
            'question_10' => 'required',
            'question_11' => 'required',
            'question_12' => 'required',
            'question_13' => 'required',
            'question_14' => 'required',
            'question_15' => 'required',
            'question_16' => 'required',
            'question_17' => 'required',
            'question_18' => 'required',
            'question_19' => 'required',
            'question_20' => 'required',
        ]);


        try {
            DB::beginTransaction();


            if (ModalityStat::where('created_by', Auth::user()->id)->first()) {
                session()->flash('error', 'Please refresh this page something goes off.');

                throw new Error('Please refresh this page something goes off.');

                return;
            }

            $visual_score = round(((floatval($data['question_1']) +
                floatval($data['question_2']) +
                floatval($data['question_3']) +
                floatval($data['question_4']) +
                floatval($data['question_5'])) / 20) * 25, 2);

            $auditory_score = round(((floatval($data['question_6']) +
                floatval($data['question_7']) +
                floatval($data['question_8']) +
                floatval($data['question_9']) +
                floatval($data['question_10'])) / 20) * 25, 2);

            $reading_and_writing_score = round(((floatval($data['question_11']) +
                floatval($data['question_12']) +
                floatval($data['question_13']) +
                floatval($data['question_14']) +
                floatval($data['question_15'])) / 20) * 25, 2);

            $kinesthetic_score = round(((floatval($data['question_16']) +
                floatval($data['question_17']) +
                floatval($data['question_18']) +
                floatval($data['question_19']) +
                floatval($data['question_20'])) / 20) * 25, 2);



            $modality = new ModalityStat();
            $modality->auditory_score = $auditory_score;
            $modality->visual_score   = $visual_score;
            $modality->kinesthetic_score = $kinesthetic_score;
            $modality->reading_and_writing_score = $reading_and_writing_score;
            $modality->created_by = Auth::user()->id;
            $modality->save();

            $maxScore = [
                'V' => $visual_score,
                'A' => $auditory_score,
                'R' => $reading_and_writing_score,
                'K' => $kinesthetic_score,
            ];

            $maxValue = max($maxScore);

            // Get all modalities with the same highest score
            $winners = array_keys($maxScore, $maxValue);

            // Default: pick the first one
            $maxKey = $winners[0];

            User::where('id', Auth::id())->update([
                'first_login' => 0,
                'preferred_modality' => $maxKey,
            ]);



            DB::commit();
            session()->flash('success', 'Please refresh this page something goes off.');

            $this->redirect(route('dashboard'));
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
        }
    }

    #[Title('Pre assessment')]
    public function render()
    {
        $question_v = SurveyModel2::where('category', 'V')->get();
        $question_a = SurveyModel2::where('category', 'A')->get();
        $question_r = SurveyModel2::where('category', 'R')->get();
        $question_k = SurveyModel2::where('category', 'K')->get();

        return view('livewire.pages.survey2', compact('question_v', 'question_a', 'question_r', 'question_k'));
    }
}
