<?php

use Illuminate\Support\Facades\Route;

// backend
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\UserBackendController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\CustomerGroupController;

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
    Route::group(['as' => 'backend.'], function () {
        Route::get('/dashboard', [BackendController::class, 'index'])->name('home');
        Route::get('profile', [UserBackendController::class, 'index'])->name('user.profile');
        Route::get('profile-info', [UserBackendController::class, 'info'])->name('profile.info');
        Route::post('profile-update/{id}', [UserBackendController::class, 'profileUpdate'])->name('profile.update');
        Route::post('password-update/{id}', [UserBackendController::class, 'passwordUpdate'])->name('password.update');
        // customer
        Route::get('customer', [CustomerController::class, 'index'])->name('customer');
        Route::get('customer-list', [CustomerController::class, 'customerList'])->name('customer.list');
        Route::post('customer/store', [CustomerController::class, 'store'])->name('customer.store');
        // customer group
        Route::get('customers-group', [CustomerGroupController::class, 'index'])->name('customerGroup');
        Route::get('group-list', [CustomerGroupController::class, 'groupList'])->name('group.list');
        Route::post('group/store', [CustomerGroupController::class, 'store'])->name('group.store');
        Route::post('group/update/{id}', [CustomerGroupController::class, 'update'])->name('group.update');
        Route::get('group/delete/{id}', [CustomerGroupController::class, 'delete'])->name('group.delete');
    });
});
