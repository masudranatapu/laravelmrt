<?php

use Illuminate\Support\Facades\Route;

// admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminBusinessController;
use App\Http\Controllers\Admin\BusinessTypeController;
use App\Http\Controllers\Admin\LoadAdminCatalogController;
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

Route::get('/admin/login', [LoginController::class, 'adminLoginForm'])->name('admin.login-view');
Route::post('/admin', [LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('profile-info', [DashboardController::class, 'info'])->name('profile.info');
    Route::post('profile-update/{id}', [DashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::post('password-update/{id}', [DashboardController::class, 'passwordUpdate'])->name('password.update');

    // businesses
    Route::get('businesses', [AdminBusinessController::class, 'index'])->name('businesses');
    Route::get('businesses/create', [AdminBusinessController::class, 'index'])->name('businesses.create');
    Route::get('businesses-list', [AdminBusinessController::class, 'businessList'])->name('business.list');

    // business type 
    Route::get('businesse-type', [BusinessTypeController::class, 'index'])->name('businesse.type');
    Route::get('businesse-type/list', [BusinessTypeController::class, 'businessTypeList'])->name('businesseType.list');
    Route::post('businesse-type/store', [BusinessTypeController::class, 'store'])->name('businesseType.store');
    Route::get('businesse-type/delete/{id}', [BusinessTypeController::class, 'delete'])->name('businesseType.delete');

    // load admin
    Route::get('load-bussiness/options', [LoadAdminCatalogController::class, 'loadBusinessOption'])->name('load.business.ption');
});
