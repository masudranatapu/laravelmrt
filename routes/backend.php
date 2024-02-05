<?php

use Illuminate\Support\Facades\Route;

// backend
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\UserBackendController;

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

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/dashboard', [BackendController::class, 'index'])->name('home');
    // user profile
    Route::get('profile', [UserBackendController::class, 'index'])->name('backend.user.profile');
});
