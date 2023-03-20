<?php

use App\Http\Controllers\SheetTaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TimekeepingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'register_action'])->name('register.action');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_action'])->name('login.action');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('forgot-password', [AuthController::class, 'forgot_password'])->name('forgot.password');
Route::post('forgot-password', [AuthController::class, 'forgot_password_action'])->name('forgot.password.action');
Route::get('confirm-otp', [AuthController::class, 'confirm_otp'])->name('confirm.otp');
Route::post('confirm-otp', [AuthController::class, 'confirm_otp_action'])->name('confirm.otp.action');
Route::get('reset-password', [AuthController::class, 'reset_password'])->name('reset.password');
Route::post('reset-password', [AuthController::class, 'reset_password_action'])->name('reset.password.action');


Route::get('/timekeeping', [TimekeepingController::class, 'index'])->name('timekeeping');
Route::get('/timekeeping/checkin', [TimekeepingController::class, 'checkin'])->name('checkin');
Route::get('/timekeeping/checkout', [TimekeepingController::class, 'checkout'])->name('checkout');


Route::get('/sheettask', [SheetTaskController::class, 'index'])->name('sheettask');
Route::post('/sheettask', [SheetTaskController::class, 'create'])->name('sheettask.create');
Route::put('/sheettask/{sheet}', [SheetTaskController::class, 'update'])->name('sheettask.update');
Route::delete('/sheettask/{sheet}', [SheetTaskController::class, 'delete'])->name('sheettask.delete');


Route::get('profile', [UserController::class, 'profile'])->name('profile');
Route::put('profile/{model}', [UserController::class, 'updateProfile'])->name('profile.update');

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user', [UserController::class, 'create'])->name('user.create');
Route::put('/user/{model}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{model}', [UserController::class, 'delete'])->name('user.delete');

Route::get('/team', [TeamController::class, 'index'])->name('team.index');