<?php

use App\Http\Controllers\DatatableController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HighChartController;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPasword;
use App\Livewire\Forms\LearningCourseForm;
use App\Livewire\Forms\LearningModuleForm;
use App\Livewire\Forms\ModuleAttachmentForm;
use App\Livewire\Forms\OrganizationForm;
use App\Livewire\Forms\SectionForm;
use App\Livewire\Forms\SetupActivitForm;
use App\Livewire\Forms\SetupQuestionForm;
use App\Livewire\Forms\UserActivityForm;
use App\Livewire\Forms\UserForm;
use App\Livewire\Pages\AccountSetting;
use App\Livewire\Pages\ChatPage;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\ManageActivity;
use App\Livewire\Pages\ManageLearningCourses;
use App\Livewire\Pages\NotificationPage;
use App\Livewire\Pages\Organizations;
use App\Livewire\Pages\Sections;
use App\Livewire\Pages\Survey;
use App\Livewire\Pages\Survey2;
use App\Livewire\Pages\UserActivity;
use App\Livewire\Pages\UserActivityResponse;
use App\Livewire\Pages\UserCourses;
use App\Livewire\Pages\Users;
use App\Livewire\Pages\VerificationNotice;
use App\Livewire\Pages\ViewCourse;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('/')->group(function () {
    Route::get('/', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
    Route::get('fogot_password', ForgotPassword::class)->name('forgot_password');

    Route::get('/reset-password/{token}', ResetPasword::class)->name('password.reset');

})->middleware('guest');

Route::middleware(['auth', 'cfs'])->group(function () {

    // student
    Route::get('/courses', UserCourses::class)->name('user_courses');
    Route::get('/courses/view/{id}', ViewCourse::class)->name('user_view_course');
    Route::get('/courses/activity', UserActivity::class)->name('user_activity');



    // System admin and teacher
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/manage/learning-course', ManageLearningCourses::class)->name('manage_learning_course');
    Route::get('/manage/manage-activity', ManageActivity::class)->name('manage_activity');

    // Account
    Route::get('/account/notifications', NotificationPage::class)->name('notification_page');
    Route::get('/account/setting', AccountSetting::class)->name('account_setting_page');
    Route::get('/account/chats', ChatPage::class)->name('chats');






    // System admin
    Route::get('/system-administration/users', Users::class)->name('users');
    Route::get('/system-administration/organizations', Organizations::class)->name('organizations');
    Route::get('/system-administration/sections', Sections::class)->name('sections');
});

Route::get('/take-survey', Survey2::class)->name('survey')->middleware('auth');


// Forms
Route::middleware(['auth', 'cfs'])->group(function () {


    // Management
    Route::get('/manage/learning-course/form/{id?}/{action?}', LearningCourseForm::class)->name('learning_course_form');
    Route::get('/manage/learning-module/form/{course_id?}/{module_id?}/{action?}', LearningModuleForm::class)->name('learning_module_form');
    Route::get('/manage/learning-module/learning_module_doc_form/form/{course_id?}/{module_id?}/{attachment_id?}/{action?}', ModuleAttachmentForm::class)->name('learning_module_doc_form');


    // System admin
    Route::get('/system-administration/section/form/{id?}/{action?}', SectionForm::class)->name('section_form');
    Route::get('/system-administration/users/form/{id?}/{action?}', UserForm::class)->name('user_form');
    Route::get('/system-administration/organization/form/{id?}/{action?}', OrganizationForm::class)->name('organization_form');
    Route::get('/system-administration/section/form/{id?}/{action?}', SectionForm::class)->name('section_form');

    // Setup Activity
    Route::get('/manage/activity/form/{id?}/{action?}', SetupActivitForm::class)->name('activity_form');
    Route::get('/manage/activity/question/form/{activity_id?}/{id?}/{action?}', SetupQuestionForm::class)->name('activity_question_form');


    // Assessment for users
    Route::get('/courses/take-activity/{activity_id}/{action}', UserActivityForm::class)->name('user_activity_form');
    Route::get('/courses/activity/{submission_id}/{action}', UserActivityResponse::class)->name('user_activity_response');
});

Route::controller(DatatableController::class)
    ->name('datatable.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/table_users', 'table_users')->name('users');
        Route::get('/table_organizations', 'table_organizations')->name('organizations');
        Route::get('/table_sections', 'table_sections')->name('sections');

        Route::get('/table_learning_courses', 'table_learning_courses')->name('learning_courses');
        Route::get('/table_learning_modules/{course_id}', 'table_learning_modules')->name('learning_modules');
        Route::get('/table_module_attachments/{module_id}', 'table_module_attachments')->name('module_attachments');
        Route::get('/table_setup_activities', 'table_setup_activities')->name('setup_activities');
        Route::get('/table_setup_questions/{activity_id?}', 'table_setup_questions')->name('setup_questions');


        Route::get('/table_course_activities/{course_id}', 'table_course_activities')->name('course_activities');
        Route::get('/table_course_activities_all', 'table_course_activities_all')->name('course_activities_all');
        

        Route::get('/table_notifications', 'table_notifications')->name('notifications');

        Route::get('/table_pending_tasks', 'table_pending_tasks')->name('table_pending_tasks');

    });

Route::controller(HighChartController::class)
    ->middleware('auth')
    ->group(function () {

        // Admin
        Route::get('/get_line_1', 'get_line_1')->name('get_line_1');

        Route::get('/get_bar_1', 'get_bar_1')->name('get_bar_1');
        Route::get('/get_bar_2', 'get_bar_2')->name('get_bar_2');

        Route::get('/get_pie_1', 'get_pie_1')->name('get_pie_1');
        Route::get('/get_pie_2', 'get_pie_2')->name('get_pie_2');
        // End Admin

        // Teacher
        Route::get('/get_t_bar_1', 'get_t_bar_1')->name('get_t_bar_1');
        // End Teacher
    });

Route::controller(EmailController::class)->middleware('auth')->group(function () {
    Route::get('/email/verify', 'showNotice')
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', 'verify')
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification', 'resend')
        ->middleware('throttle:3,1')
        ->name('verification.send');
});
