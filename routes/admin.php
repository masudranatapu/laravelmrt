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
    Route::get('businesses', [AdminBusinessController::class, 'index'])->name('businesses');
    Route::get('businesses-list', [AdminBusinessController::class, 'businessList'])->name('business.list');
    Route::get('businesses/create', [AdminBusinessController::class, 'create'])->name('business.create');
    Route::post('businesses/store', [AdminBusinessController::class, 'store'])->name('business.store');
    // business type
    Route::get('business-type', [BusinessTypeController::class, 'index'])->name('business.type');
    Route::get('business-type/list', [BusinessTypeController::class, 'businessTypeList'])->name('businessType.list');
    Route::post('business-type/store', [BusinessTypeController::class, 'store'])->name('businessType.store');
    Route::get('business-type/edit/{id}', [BusinessTypeController::class, 'edit'])->name('businessType.edit');
    Route::post('business-type/update/{id}', [BusinessTypeController::class, 'update'])->name('businessType.update');
    Route::get('business-type/status/change/{id}', [BusinessTypeController::class, 'statusChange'])->name('businessType.status.change');
    Route::get('business-type/delete/{id}', [BusinessTypeController::class, 'delete'])->name('businessType.delete');
    // pricing-plans
    Route::get('pricing-plans', [PricingPlanController::class, 'index'])->name('pricingPlan');
    Route::get('pricing-plans/list', [PricingPlanController::class, 'pricingPlanList'])->name('pricingPlan.list');
    Route::post('pricing-plans/store', [PricingPlanController::class, 'store'])->name('pricingPlan.store');
    Route::get('pricing-plans/edit/{id}', [PricingPlanController::class, 'edit'])->name('pricingPlan.edit');
    Route::post('pricing-plans/update/{id}', [PricingPlanController::class, 'update'])->name('pricingPlan.update');
    Route::get('pricing-plans/delete/{id}', [PricingPlanController::class, 'delete'])->name('pricingPlan.delete');
    // package
    Route::get('package', [PackageController::class, 'index'])->name('package');
    Route::get('package-list', [PackageController::class, 'packageList'])->name('package.list');
    Route::post('package/store', [PackageController::class, 'store'])->name('package.store');
    Route::get('package/edit/{id}', [PackageController::class, 'edit'])->name('package.edit');
    Route::post('package/update/{id}', [PackageController::class, 'update'])->name('package.update');
    Route::get('package/delete/{id}', [PackageController::class, 'delete'])->name('package.delete');
    // load admin
    Route::get('load-admin/users', [LoadAdminCatalogController::class, 'loadAdminUsers'])->name('load.admin');
    Route::get('load-bussiness/options', [LoadAdminCatalogController::class, 'loadBusinessOption'])->name('load.business.option');
    // Testimonial
    Route::get('testimonial', [TestimonialController::class, 'index'])->name('testimonials');
    Route::get('testimonial-list', [TestimonialController::class, 'testimonialList'])->name('testimonial.list');
    Route::post('testimonial/store', [TestimonialController::class, 'store'])->name('testimonial.store');
    Route::get('testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
    Route::post('testimonial/update/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
    Route::get('testimonial/status/change/{id}', [TestimonialController::class, 'changeStatus'])->name('testimonial.status.change');
    Route::get('testimonial/delete/{id}', [TestimonialController::class, 'delete'])->name('testimonial.delete');
});
