<?php

use Illuminate\Support\Facades\Route;

// admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminBusinessController;
use App\Http\Controllers\Admin\BusinessTypeController;
use App\Http\Controllers\Admin\LoadAdminCatalogController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PricingPlanController;
use App\Http\Controllers\Admin\TestimonialController;
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
    Route::resource('businesses', AdminBusinessController::class);
    Route::get('businesses-list', [AdminBusinessController::class, 'dataList'])->name('business.list');
    // business type
    Route::resource('business-type', BusinessTypeController::class);
    Route::get('business-type-list', [BusinessTypeController::class, 'dataList'])->name('businessType.list');
    Route::get('business-type/status/change/{id}', [BusinessTypeController::class, 'statusChange'])->name('businessType.status.change');
    Route::get('business-type-bulk-delete', [BusinessTypeController::class, 'bulkDelete'])->name('businessType.bulkDelete');
    // pricing-plans
    Route::resource('pricing-plans', PricingPlanController::class);
    Route::get('pricing-plans-list', [PricingPlanController::class, 'dataList'])->name('pricingPlan.list');
    Route::get('pricing-plans-bulk-delete', [PricingPlanController::class, 'bulkDelete'])->name('pricingPlan.bulkDelete');
    // package
    Route::resource('package', PackageController::class);
    Route::get('package-list', [PackageController::class, 'dataList'])->name('package.list');
    Route::get('package-bulk-delete', [PackageController::class, 'bulkDelete'])->name('package.bulkDelete');
    // load admin
    Route::get('load-admin/users', [LoadAdminCatalogController::class, 'loadAdminUsers'])->name('load.admin');
    Route::get('load-bussiness/options', [LoadAdminCatalogController::class, 'loadBusinessOption'])->name('load.business.option');
    Route::get('pricing-plan/{id}', [LoadAdminCatalogController::class, 'pricingPlan'])->name('pricing.plan');
    Route::get('package-info/{id}', [LoadAdminCatalogController::class, 'packageInfo'])->name('package.info');
    // Testimonial
    Route::resource('testimonial', TestimonialController::class);
    Route::get('testimonial-list', [TestimonialController::class, 'dataList'])->name('testimonial.list');
    Route::get('testimonial-status/change/{id}', [TestimonialController::class, 'statusChange'])->name('testimonial.status.change');
    Route::get('testimonial-bulk-delete', [TestimonialController::class, 'bulkDelete'])->name('testimonial.bulkDelete');
});
