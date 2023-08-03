<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\FileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Livewire\Doctor\Profile;
use App\Http\Livewire\Doctor\HighSchool;
use App\Http\Livewire\Doctor\HigherEducation;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->prefix('doctor')->group(function() {
    Route::get('/dashboard', [DoctorController::class, 'index'])->name('doctor.dashbaord');
    Route::get('/profile', Profile::class)->name('doctor.profile');
    Route::get('/profile/high-school', HighSchool::class)->name('doctor.profile.high-school');
    Route::get('/profile/higher-education', HigherEducation::class)->name('doctor.profile.higher-education');

    // Files Controller
    Route::get('/files/download', [FileController::class, 'download'])->name('files.download');
    Route::get('/files/delete', [FileController::class, 'delete'])->name('files.delete');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashbaord');
});
