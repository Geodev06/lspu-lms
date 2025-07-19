<?php

namespace App\Livewire\Pages;

use App\Models\ModalityBandit;
use App\Models\Notification;
use App\Models\ParamLearningCourse;
use App\Models\ParamSection;
use App\Models\SetupActivity;
use App\Models\User;
use App\Models\UserActivitySubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{


    use WithPagination;

    #[Title('Dashboard')]
    #[Layout('components.layouts.app')]
    public function render()
    {


        $data = [];

        $user_id = Auth::user()->id;

        switch (Auth::user()->role) {


            case ROLE_ADMIN:

                $data = [
                    'users_count' => User::count(),
                    'courses_count' => ParamLearningCourse::where('active_flag', 'Y')->count(),
                    'activity_count' => SetupActivity::where('active_flag', 'Y')->count(),
                    'section_count' => ParamSection::count(),
                    'submission_count_today' => UserActivitySubmission::whereDate('created_at', now())->count(),
                    'submission_count_overall' => UserActivitySubmission::count(),
                    'notification_count' => Notification::where('receiver_id', Auth::user()->id)->where('seen_flag', 0)->count(),
                    'bandit_count' => ModalityBandit::count(),
                    'submission_history' => UserActivitySubmission::join('setup_activities as B', 'B.id', '=', 'user_activity_submissions.activity_id')
                        ->where('B.created_by', $user_id)
                        ->orderByDesc('user_activity_submissions.created_at')
                        ->select('user_activity_submissions.*')
                        ->paginate(5)
                ];


                break;

            case ROLE_TEACHER:
                $data = [
                    'courses_count' => ParamLearningCourse::where('active_flag', 'Y')->where('created_by', $user_id)->count(),
                    'activity_count' => SetupActivity::where('active_flag', 'Y')->where('created_by', $user_id)->count(),
                    'submission_count_today' => UserActivitySubmission::join('setup_activities as b', 'b.id', '=', 'user_activity_submissions.activity_id')
                        ->where('b.created_by', $user_id)
                        ->whereDate('user_activity_submissions.created_at', now())
                        ->count('user_activity_submissions.activity_id'),

                    'notification_count' => Notification::where('receiver_id', Auth::user()->id)->where('seen_flag', 0)->count(),
                    'submission_history' => UserActivitySubmission::join('setup_activities as B', 'B.id', '=', 'user_activity_submissions.activity_id')
                        ->where('B.created_by', $user_id)
                        ->orderByDesc('user_activity_submissions.created_at')
                        ->select('user_activity_submissions.*')
                        ->paginate(10)
                ];

                break;

            case ROLE_STUDENT:

                $data = [
                    'submission_count_today' => UserActivitySubmission::where('created_by', $user_id)->count(),
                    'my_avg_grade' => round(
                        UserActivitySubmission::where('created_by', $user_id)->avg('grade'),
                        2
                    ),
                    'my_passing_rate' => UserActivitySubmission::where('created_by', $user_id)->count() > 0
                        ? round(UserActivitySubmission::where('created_by', $user_id)->where('grade', '>=', 75)->count() / UserActivitySubmission::where('created_by', $user_id)->count(), 2)
                        : 0,


                    'notification_count' => Notification::where('receiver_id', Auth::user()->id)->where('seen_flag', 0)->count(),
                    'my_submission_history' => UserActivitySubmission::where('created_by', $user_id)->paginate(10),

                ];
                break;

            default:
                Auth::logout();
                session()->regenerate(true);
                break;
        }
        return view('livewire.pages.dashboard', compact('data'));
    }
}
