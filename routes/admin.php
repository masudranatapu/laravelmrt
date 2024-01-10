<?php

use Illuminate\Support\Facades\Route;

// admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| admin routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin/login',[LoginController::class,'adminLoginForm'])->name('admin.login-view');
Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});