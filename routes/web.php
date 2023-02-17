<?php

use App\Http\Controllers\SheetTaskController;
use App\Http\Controllers\TimekeepingController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('profile', [UserController::class, 'profile'])->name('profile');

Route::get('/timekeeping', [TimekeepingController::class, 'index'])->name('timekeeping');
Route::get('/timekeeping/checkin', [TimekeepingController::class, 'checkin'])->name('checkin');
Route::get('/timekeeping/checkout', [TimekeepingController::class, 'checkout'])->name('checkout');


Route::get('/sheettask', [SheetTaskController::class, 'index'])->name('sheettask');
// Route::get('/timesheet', [SheetTaskController::class, 'index'])->name('timesheet');
// Route::get('/sheettask/create', [SheetTaskController::class, 'create'])->name('sheettask.create');
// Route::post('/sheettask/updatecreate', [SheetTaskController::class, 'updatecreate'])->name('sheettask.update');
Route::post('/sheettask/updatecreate', [SheetTaskController::class, 'updatecreate'])->name('sheettask.update');
