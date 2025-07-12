<?php

use App\Http\Controllers\DatatableController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Forms\LearningCourseForm;
use App\Livewire\Forms\LearningModuleForm;
use App\Livewire\Forms\ModuleAttachmentForm;
use App\Livewire\Forms\OrganizationForm;
use App\Livewire\Forms\SectionForm;
use App\Livewire\Forms\SetupActivitForm;
use App\Livewire\Forms\SetupQuestionForm;
use App\Livewire\Forms\UserForm;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\ManageActivity;
use App\Livewire\Pages\ManageLearningCourses;
use App\Livewire\Pages\Organizations;
use App\Livewire\Pages\Sections;
use App\Livewire\Pages\Survey;
use App\Livewire\Pages\Users;
use Illuminate\Support\Facades\Auth;
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
})->middleware('guest');

Route::middleware(['auth', 'cfs'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/manage/learning-course', ManageLearningCourses::class)->name('manage_learning_course');
    Route::get('/manage/manage-activity', ManageActivity::class)->name('manage_activity');



    // System admin
    Route::get('/system-administration/users', Users::class)->name('users');
    Route::get('/system-administration/organizations', Organizations::class)->name('organizations');
    Route::get('/system-administration/sections', Sections::class)->name('sections');
});

Route::get('/take-survey', Survey::class)->name('survey');


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


    
});

Route::controller(DatatableController::class)
    ->name('datatable.')
    ->group(function () {
        Route::get('/table_users', 'table_users')->name('users');
        Route::get('/table_organizations', 'table_organizations')->name('organizations');
        Route::get('/table_sections', 'table_sections')->name('sections');

        Route::get('/table_learning_courses', 'table_learning_courses')->name('learning_courses');
        Route::get('/table_learning_modules/{course_id}', 'table_learning_modules')->name('learning_modules');
        Route::get('/table_module_attachments/{module_id}', 'table_module_attachments')->name('module_attachments');
        Route::get('/table_setup_activities', 'table_setup_activities')->name('setup_activities');
        Route::get('/table_setup_questions/{activity_id?}', 'table_setup_questions')->name('setup_questions');





    });
