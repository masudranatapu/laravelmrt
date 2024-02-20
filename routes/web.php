<?php

use Illuminate\Support\Facades\Auth;
// frontend
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProjectController;

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

Route::get('/', [FrontendController::class, 'index']);

Auth::routes(); // ['register' => false]

Route::group(['as' => 'frontend.'], function () {
    Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('/about', [FrontendController::class, 'about'])->name('about');
    Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
    Route::get('/service', [FrontendController::class, 'service'])->name('service');
    Route::get('/testimonial', [FrontendController::class, 'testimonial'])->name('testimonial');
    Route::get('/team', [FrontendController::class, 'team'])->name('team');
    // project
    Route::get('/project', [ProjectController::class, 'project'])->name('project');
    Route::get('/project/details', [ProjectController::class, 'projectDetails'])->name('project.details');
    
    Route::post('/newsletter', [FrontendController::class, 'newsletter'])->name('newsletter');
});