<?php

use App\Http\Controllers\DatatableController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Forms\UserForm;
use App\Livewire\Pages\Dashboard;
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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/system-administration/users', Users::class)->name('users');
});



// Forms
Route::middleware('auth')->group(function () {
    Route::get('/system-administration/users/form/{id?}', UserForm::class)->name('user_form');
});

Route::controller(DatatableController::class)
    ->name('datatable.')  
    ->group(function () {
        Route::get('/table_users', 'table_users')->name('users');
    });
