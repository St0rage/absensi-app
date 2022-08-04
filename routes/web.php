<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RecapController;
use App\Http\Controllers\SubjectController;
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
Route::get('/dashboard/classroom/subject/{classroom:slug}', [ClassroomController::class, 'showSubjects'])->middleware('admin');
Route::post('/dashboard/classroom/participant', [ClassroomController::class, 'addParticipant'])->middleware('admin');
Route::post('/dashboard/classroom/subject', [ClassroomController::class, 'addSubject'])->middleware('admin');
Route::delete('/dashboard/classroom/subject/{classroom:slug}', [ClassroomController::class, 'destroySubject'])->middleware('admin');
Route::resource('/dashboard/classroom', ClassroomController::class)->middleware('admin');
// END DASHBOARD-CLASSROOM

// DASHBOARD-SUBJECT
Route::resource('/dashboard/subject', SubjectController::class)->middleware('admin');
// END DASHBOARD-SUBJECT

// DASHBOARD-PROFILE
Route::resource('/dashboard/profile', ProfilController::class)->middleware('auth');
// END DASHBOARD-PROFILE

// DASHBOARD-ATTENDANCE
Route::get('/dashboard/attendance/create/{attendance}', [AttendanceController::class, 'createAttendance'])->middleware('student');
Route::get('/dashboard/attendance/check-meeting', [AttendanceController::class, 'checkMeeting'])->middleware('lecture');
Route::post('/dashboard/attendance/store-attendance', [AttendanceController::class, 'storeAttendance'])->middleware('student');
Route::get('/dashboard/attendance/recap', [AttendanceController::class, 'recap'])->middleware('lecture');
Route::get('/dashboard/attendance/recap/show', [AttendanceController::class, 'showRecap'])->middleware('lecture');
Route::get('/dashboard/attendance/recap/detail', [AttendanceController::class, 'detailRecap'])->middleware('lecture');
Route::get('/dashboard/attendance/recap/detail/{attendance}', [AttendanceController::class, 'detailedRecap'])->middleware('lecture');
Route::resource('/dashboard/attendance', AttendanceController::class)->middleware('lecture');
// END DASHBOARD-ATTENDANCE

// DASHBOARD-ATTENDANCE
Route::get('/dashboard/recap/show', [RecapController::class, 'showRecap'])->middleware('admin');
Route::get('/dashboard/recap/detail', [RecapController::class, 'detailRecap'])->middleware('admin');
Route::get('/dashboard/recap/detail/{attendance}', [RecapController::class, 'detailedRecap'])->middleware('admin');
Route::resource('/dashboard/recap', RecapController::class)->middleware('admin');
// END DASHBOARD-ATTENDANCE


// DASHBOARD
Route::resource('/dashboard', DashboardController::class)->middleware('auth');
// END DASHBOARD
