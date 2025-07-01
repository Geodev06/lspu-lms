<?php

use App\Http\Controllers\DatatableController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Forms\OrganizationForm;
use App\Livewire\Forms\SectionForm;
use App\Livewire\Forms\UserForm;
use App\Livewire\Pages\Dashboard;
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
    Route::get('/system-administration/users', Users::class)->name('users');
    Route::get('/system-administration/organizations', Organizations::class)->name('organizations');
    Route::get('/system-administration/sections', Sections::class)->name('sections');
});

Route::get('/take-survey', Survey::class)->name('survey');


// Forms
Route::middleware(['auth', 'cfs'])->group(function () {
    Route::get('/system-administration/users/form/{id?}/{action?}', UserForm::class)->name('user_form');
    Route::get('/system-administration/organization/form/{id?}/{action?}', OrganizationForm::class)->name('organization_form');
    Route::get('/system-administration/section/form/{id?}/{action?}', SectionForm::class)->name('section_form');
});

Route::controller(DatatableController::class)
    ->name('datatable.')
    ->group(function () {
        Route::get('/table_users', 'table_users')->name('users');
        Route::get('/table_organizations', 'table_organizations')->name('organizations');
        Route::get('/table_sections', 'table_sections')->name('sections');
    });
