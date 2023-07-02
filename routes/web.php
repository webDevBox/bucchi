<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OfficeController;

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

Route::get('/',[AuthController::class, 'login'])->name('login');

// Route::group(function () {
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('adminDashboard');
        Route::prefix('order')->group(function () {
            Route::get('/create',[OrderController::class, 'create'])->name('createOrder');
            Route::get('/view',[OrderController::class, 'view'])->name('viewOrder');
            Route::get('/outfit',[OrderController::class, 'OutFitDetails'])->name('OutFitDetails');
            Route::get('/changes',[OrderController::class, 'changes'])->name('outfitChanges');
            Route::get('/search',[OrderController::class, 'search'])->name('searchOrder');
            Route::get('/update/{id}',[OrderController::class, 'update'])->name('orderUpdate');
        });
    });
    Route::prefix('office')->group(function() {
        Route::get('dashboard',[OfficeController::class, 'index'])->name('officeDashboard');
        Route::get('outfits',[OfficeController::class, 'outfits'])->name('outfits');
        Route::get('outfits/profile',[OfficeController::class, 'outfitProfile'])->name('outfitProfile');
        Route::get('order/search',[OfficeController::class, 'orderSearch'])->name('orderSearch');
    });
// });
