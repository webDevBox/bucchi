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

Route::middleware(['auth.login'])->group(function () {
    Route::get('/',[AuthController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('auth');
});

// Route::group(function () {
    Route::middleware('auth.admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('adminDashboard');
        Route::prefix('order')->group(function () {
            Route::get('/byId',[OrderController::class, 'byId'])->name('byId');
            Route::get('/create',[OrderController::class, 'create'])->name('createOrder');
            Route::get('/storeClient',[OrderController::class, 'storeClient'])->name('storeClient');
            Route::get('/storeOrder',[OrderController::class, 'storeOrder'])->name('storeOrder');
            Route::get('/storeOutfits',[OrderController::class, 'storeOutfits'])->name('storeOutfits');
            Route::get('/completeOrder',[OrderController::class, 'completeOrder'])->name('completeOrder');

            Route::get('/view',[OrderController::class, 'view'])->name('viewOrder');
            Route::get('/outfit/{id}',[OrderController::class, 'OutFitDetails'])->name('OutFitDetails');
            Route::get('/production/outfit',[OrderController::class, 'OutfitProduction'])->name('OutfitProduction');
            
            Route::get('/outfits',[OrderController::class, 'getOrderOutfits'])->name('getOrderOutfits');
            Route::get('/changes',[OrderController::class, 'changes'])->name('outfitChanges');
            Route::get('/search',[OrderController::class, 'search'])->name('searchOrder');
            Route::get('/update/{id}',[OrderController::class, 'update'])->name('orderUpdate');
            Route::get('production',[AdminController::class, 'production'])->name('productionLine');
            Route::get('outfitProfile/{id}',[AdminController::class, 'outfitProfile'])->name('adminOutfitProfile');
        });
    });
    Route::middleware('auth.office')->prefix('office')->group(function() {
        Route::get('dashboard',[OfficeController::class, 'index'])->name('officeDashboard');
        Route::get('outfits',[OfficeController::class, 'outfits'])->name('outfits');
        Route::get('outfits/profile',[OfficeController::class, 'outfitProfile'])->name('outfitProfile');
        Route::get('order/search',[OfficeController::class, 'orderSearch'])->name('orderSearch');
    });
// });

Route::get('/logout',[AuthController::class, 'logout'])->name('logout');