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
use App\Http\Controllers\Backend\AccountController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\ExpenseTypeController;

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
        Route::resource('customers-group', CustomerGroupController::class);
        Route::get('group-list', [CustomerGroupController::class, 'groupList'])->name('group.list');
        Route::get('group/status/change/{id}', [CustomerGroupController::class, 'statusChange'])->name('group.status.change');
        Route::get('group-bulk-delete', [CustomerGroupController::class, 'bulkDelete'])->name('group.bulkDelete');
        // area
        Route::resource('area', AreaController::class);
        Route::get('area-list', [AreaController::class, 'areaList'])->name('area.list');
        Route::get('area-type-bulk-delete', [AreaController::class, 'bulkDelete'])->name('area.bulkDelete');
        Route::get('area/status/change/{id}', [AreaController::class, 'statusChange'])->name('area.status.change');
        // asset category
        Route::resource('asset-category', AssetCategoryController::class);
        Route::get('asset-category-list', [AssetCategoryController::class, 'assetCategoryList'])->name('assetCategory.list');
        Route::get('asset-category-bulk-delete', [AssetCategoryController::class, 'bulkDelete'])->name('assetCategory.delete');
        Route::get('asset-category-status/change/{id}', [AssetCategoryController::class, 'changeStatus'])->name('assetCategory.status.change');
        // asset
        Route::resource('assets', AssetController::class);
        Route::get('assets-list', [AssetController::class, 'assetsList'])->name('assets.list');
        Route::get('assets-bulk-delete', [AssetController::class, 'bulkDelete'])->name('area.bulkDelete');
        // account
        Route::resource('account', AccountController::class);
        Route::get('account-list', [AccountController::class, 'list'])->name('account.list');
        Route::get('account-status-change/{id}', [AccountController::class, 'statusChange'])->name('account.status.change');
        Route::get('account-bulk-delete', [AccountController::class, 'bulkDelete'])->name('account.bulkDelete');
        // expense-types
        Route::resource('expense-types', ExpenseTypeController::class);
        Route::get('expense-types-list', [ExpenseTypeController::class, 'dataList'])->name('expense.type.list');
        Route::get('expense-types-status-change/{id}', [ExpenseTypeController::class, 'statusChange'])->name('expense.typeStatus.change');
        Route::get('expense-types-bulk-delete', [ExpenseTypeController::class, 'bulkDelete'])->name('expense.type.bulkDelete');
        // expense
        Route::resource('expense', ExpenseController::class);
        Route::get('expense-list', [ExpenseController::class, 'list'])->name('expense.list');
        Route::get('expense-status-change/{id}', [ExpenseController::class, 'statusChange'])->name('expenseStatus.change');
        Route::get('expense-bulk-delete', [ExpenseController::class, 'bulkDelete'])->name('expense.bulkDelete');
        // load catalog
        Route::get('load-group', [LoadCatalogController::class, 'loadGroup'])->name('load.group');
        Route::get('load-area', [LoadCatalogController::class, 'loadArea'])->name('load.area');
        Route::get('load-asset-category', [LoadCatalogController::class, 'loadAssetCategory'])->name('load.asset.category');
        Route::get('load-account-types', [LoadCatalogController::class, 'accountTypesList'])->name('load.accountType');
        Route::get('load-mobile-banking-names', [LoadCatalogController::class, 'mobileBankingLIst'])->name('load.mobileBanking');
    });
});
