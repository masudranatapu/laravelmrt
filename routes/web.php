<?php

use Illuminate\Support\Facades\Route;

// backend
use App\Http\Controllers\Backend\AdminController;
// admin
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


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

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('home');
});


Route::get('/sadmin/login',[LoginController::class,'sadminLoginForm'])->name('admin.login-view');
Route::post('/admin',[LoginController::class,'sadminLogin'])->name('admin.login');

Route::group(['as' => 'sadmin.', 'prefix' => 'sadmin', 'middleware' => 'auth:admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});