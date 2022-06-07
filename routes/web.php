<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// RESET PASSWORD
Route::get('/forgot-password', function() {
    return view('login.forgot');
})->middleware('guest')->name('password.reset');

Route::get('/forgot-password/{token}', function($token) {
    return view('login.reset', [
        'token' => $token
    ]);
})->middleware('guest')->name('password.reset');

Route::post('/forgot-password', [LoginController::class, 'forgotPassword']);
Route::post('/reset-password', [LoginController::class, 'resetPassword'])->middleware('guest')->name('password.update');
// END RESET PASSWORD

// DASHBOARD-USER
Route::resource('/dashboard/user', UserController::class)->middleware('admin');
// END DASHBOARD-USER

// DASHBOARD-CLASSROOM
Route::get('/dashboard/classroom/participant/{classroom:slug}', [ClassroomController::class, 'showParticipant'])->middleware('admin');
Route::post('/dashboard/classroom/participant', [ClassroomController::class, 'addParticipant'])->middleware('admin');
Route::resource('/dashboard/classroom', ClassroomController::class)->middleware('admin');
// END DASHBOARD-CLASSROOM


Route::get('/dashboard', function() {
    return view('dashboard.index');
})->middleware('auth');
