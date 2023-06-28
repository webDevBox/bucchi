<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

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
    Route::get('/dashboard', [AdminController::class, 'index'])->name('adminDashboard');
    Route::prefix('order')->group(function () {
        Route::get('/create',[OrderController::class, 'create'])->name('createOrder');
        Route::get('/view',[OrderController::class, 'view'])->name('viewOrder');
    });
// });
