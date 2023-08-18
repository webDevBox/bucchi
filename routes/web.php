<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PettyController;
use App\Http\Controllers\ScheduleController;

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

    Route::middleware('auth.admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('adminDashboard');
        Route::get('/pettyListAdmin', [PettyController::class, 'pettyListAdmin'])->name('pettyListAdmin');

        Route::prefix('client')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('clientPage');
        });
        
        Route::prefix('scheduling')->group(function () {
            Route::get('/', [ScheduleController::class, 'index'])->name('scheduling');
            Route::get('/create', [ScheduleController::class, 'create'])->name('create');
            Route::get('/availability', [ScheduleController::class, 'availability'])->name('availability');
        });
        
        Route::prefix('profile')->group(function () {
            Route::get('/', [AdminController::class, 'profile'])->name('adminProfile');
            Route::post('/updateAdmin', [AdminController::class, 'updateAdmin'])->name('updateAdmin');
        });

        Route::prefix('office')->group(function (){
            Route::get('/',[OfficeController::class, 'list'])->name('officeList');
            Route::get('delete/{id}',[OfficeController::class, 'officeDelete'])->name('officeDelete');
            Route::post('createOffice',[OfficeController::class, 'createOffice'])->name('createOffice');
            Route::get('editOffice/{id}',[OfficeController::class, 'editOffice'])->name('editOffice');
            Route::post('updateOffice/{id}',[OfficeController::class, 'updateOffice'])->name('updateOffice');
        });
        
        Route::prefix('order')->group(function () {
            Route::get('/byId',[OrderController::class, 'byId'])->name('byId');
            Route::get('/create',[OrderController::class, 'create'])->name('createOrder');
            Route::get('/storeClient',[OrderController::class, 'storeClient'])->name('storeClient');
            Route::get('/storeOrder',[OrderController::class, 'storeOrder'])->name('storeOrder');
            Route::get('/storeOutfits',[OrderController::class, 'storeOutfits'])->name('storeOutfits');
            Route::get('/updateOutfits',[OrderController::class, 'updateOutfits'])->name('updateOutfits');
            Route::get('/completeOrder',[OrderController::class, 'completeOrder'])->name('completeOrder');
            Route::get('/markAsComplete',[OrderController::class, 'markAsComplete'])->name('markAsComplete');

            Route::get('/view',[OrderController::class, 'view'])->name('viewOrder');
            Route::get('/outfit/{id}',[OrderController::class, 'OutFitDetails'])->name('OutFitDetails');
            Route::get('/production/outfit',[OrderController::class, 'OutfitProduction'])->name('OutfitProduction');
            
            Route::get('/outfits',[OrderController::class, 'getOrderOutfits'])->name('getOrderOutfits');
            Route::get('/changes',[OrderController::class, 'changes'])->name('outfitChanges');
            Route::get('/search',[OrderController::class, 'search'])->name('searchOrder');
            Route::get('/update/{id}',[OrderController::class, 'update'])->name('orderUpdate');
            Route::get('/delete/{id}',[OrderController::class, 'delete'])->name('delete');
            Route::get('production',[AdminController::class, 'production'])->name('productionLine');
            Route::get('outfitProfile/{id}',[AdminController::class, 'outfitProfile'])->name('adminOutfitProfile');
            Route::post('sendMaterial',[AdminController::class, 'sendMaterial'])->name('sendMaterial');

            Route::get('/draft',[OrderController::class, 'draft'])->name('draftOrders');
        });
    });
    Route::middleware('auth.office')->prefix('office')->group(function() {
        Route::prefix('client')->group(function () {
            Route::get('/', [ClientController::class, 'clientPageOffice'])->name('clientPageOffice');
        });
        Route::prefix('petty')->group(function (){
            Route::get('/',[PettyController::class, 'index'])->name('pettyList');
            Route::post('create',[PettyController::class, 'createPetty'])->name('createPetty');
        });
        Route::get('dashboard',[OfficeController::class, 'index'])->name('officeDashboard');
        Route::get('outfits',[OfficeController::class, 'outfits'])->name('outfits');
        Route::get('outfits/profile/{id}',[OfficeController::class, 'outfitProfile'])->name('outfitProfile');
        Route::get('order/search',[OfficeController::class, 'orderSearch'])->name('orderSearch');
    });
    Route::middleware('auth.common')->group(function() {
        Route::get('/generatePDF/{id}', [OrderController::class, 'generatePDF'])->name('generatePDF');
        Route::get('delete/{id}',[PettyController::class, 'pettyDelete'])->name('pettyDelete');
        Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
        Route::get('/checkFileNum', [ClientController::class, 'checkFileNum']);
        Route::get('/createClient', [ClientController::class, 'createClient']);
        Route::get('/getFile', [ClientController::class, 'getFile'])->name('getFile');
        Route::get('/deleteClient', [ClientController::class, 'deleteClient'])->name('deleteClient');
        Route::get('/editClient/{id}', [ClientController::class, 'editClient'])->name('editClient');
        Route::post('/updateClient/{id}', [ClientController::class, 'updateClient'])->name('updateClient');
        Route::post('updateOutfitProductin/{id}', [OrderController::class, 'updateOutfitProductin'])->name('updateOutfitProductin');
        Route::get('deleteMaterialImage/{id}', [OrderController::class, 'deleteMaterialImage'])->name('deleteMaterialImage');

    });
    