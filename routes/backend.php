<?php

use Illuminate\Support\Facades\Route;

// backend
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\UserBackendController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\CustomerGroupController;
use App\Http\Controllers\Backend\AreaController;
use App\Http\Controllers\Backend\AssetCategoryController;
use App\Http\Controllers\Backend\AssetController;
use App\Http\Controllers\Backend\LoadCatalogController;
use App\Http\Controllers\Backend\SupplierController;

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
        Route::get('user/list', [UserBackendController::class, 'userList'])->name('user.list');
        // supplier
        Route::resource('supplier', SupplierController::class);
        Route::get('supplier-list', [SupplierController::class, 'supplierList'])->name('supplier.list');
        Route::get('supplier/status-change/{id}', [SupplierController::class, 'changeStatus'])->name('supplier.status.change');
        Route::get('supplier-bulk-delete', [SupplierController::class, 'bulkDelete'])->name('supplier.bulkDelete');
        // customer
        Route::resource('customer', CustomerController::class);
        Route::get('customer-list', [CustomerController::class, 'customerList'])->name('customer.list');
        Route::get('customer/status-change/{id}', [CustomerController::class, 'changeStatus'])->name('customer.status.change');
        Route::get('customer-bulk-delete', [CustomerController::class, 'bulkDelete'])->name('customer.bulkDelete');
        // customer group
        Route::get('customers-group', [CustomerGroupController::class, 'index'])->name('customerGroup');
        Route::get('group-list', [CustomerGroupController::class, 'groupList'])->name('group.list');
        Route::post('group/store', [CustomerGroupController::class, 'store'])->name('group.store');
        Route::get('group/edit/{id}', [CustomerGroupController::class, 'edit'])->name('group.edit');
        Route::post('group/update/{id}', [CustomerGroupController::class, 'update'])->name('group.update');
        Route::get('group/delete/{id}', [CustomerGroupController::class, 'delete'])->name('group.delete');
        Route::get('group/status/change/{id}', [CustomerGroupController::class, 'statusChange'])->name('group.status.change');
        // area
        Route::resource('area', AreaController::class);
        Route::get('area-list', [AreaController::class, 'areaList'])->name('area.list');
        Route::get('area-type-bulk-delete', [AreaController::class, 'bulkDelete'])->name('area.bulkDelete');
        Route::get('area/status/change/{id}', [AreaController::class, 'statusChange'])->name('area.status.change');
        // load catalog
        Route::get('load-group', [LoadCatalogController::class, 'loadGroup'])->name('load.group');
        Route::get('load-area', [LoadCatalogController::class, 'loadArea'])->name('load.area');
        Route::get('load-asset-category', [LoadCatalogController::class, 'loadAssetCategory'])->name('load.asset.category');
        // asset category
        Route::resource('asset-category', AssetCategoryController::class);
        Route::get('asset-category-list', [AssetCategoryController::class, 'assetCategoryList'])->name('assetCategory.list');
        Route::get('asset-category-bulk-delete', [AssetCategoryController::class, 'bulkDelete'])->name('assetCategory.delete');
        Route::get('asset-category-status/change/{id}', [AssetCategoryController::class, 'changeStatus'])->name('assetCategory.status.change');
        // asset
        Route::resource('assets', AssetController::class);
        Route::get('assets-list', [AssetController::class, 'assetsList'])->name('assets.list');
        Route::get('assets-bulk-delete', [AssetController::class, 'bulkDelete'])->name('area.bulkDelete');
    });
});
