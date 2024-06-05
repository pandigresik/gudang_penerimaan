<?php

use App\Http\Controllers\Warehouse\GoodReceiptController;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tes', [App\Http\Controllers\HomeController::class, 'tes']);
Route::get('password.change', [\App\Http\Controllers\Auth\ChangePasswordController::class, 'showResetForm'])->name('password.change');
Route::post('password.change', [\App\Http\Controllers\Auth\ChangePasswordController::class, 'reset'])->name('password.change');

//Route::group(['middleware' => ['auth','role:administrator']],function (){
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'base'], function () {
        Route::resource('import', Base\ImportController::class, ['as' => 'base']);
        Route::resource('export', Base\ExportController::class, ['as' => 'base']);
        Route::resource('roles', Base\RoleController::class, ["as" => 'base', 'middleware' => ['easyauth']]);
        Route::resource('permissions', Base\PermissionController::class, ["as" => 'base', 'middleware' => ['easyauth']]);
        Route::resource('users', Base\UserController::class, ["as" => 'base', 'middleware' => ['easyauth']]);
        Route::resource('menus', Base\MenusController::class, ["as" => 'base', 'middleware' => ['easyauth']]);
        Route::resource('partners', Base\PartnerController::class, ["as" => 'base', 'middleware' => ['easyauth']]);
        Route::resource('products', Base\ProductController::class, ["as" => 'base', 'middleware' => ['easyauth']]);
    });

    Route::group(['prefix' => 'inventory'], function(){        

    });
    Route::get('/selectAjax', [App\Http\Controllers\SelectAjaxController::class, 'index'])->name('selectAjax');
    Route::get('/storage', 'StorageController');
});

Route::group(['prefix' => 'artisan'], function () {
    Route::get('clear_cache', function () {
        Artisan::call('cache:clear');
    });
});


Route::group(['prefix' => 'warehouse'], function () {    
    Route::get('goodReceipts/excel', [GoodReceiptController::class, 'excel']);
    Route::resource('goodReceipts', Warehouse\GoodReceiptController::class, ["as" => 'warehouse']);    
    Route::resource('goodReceiptItems', Warehouse\GoodReceiptItemController::class, ["as" => 'warehouse']);
    Route::resource('goodReceiptItemWeights', Warehouse\GoodReceiptItemWeightController::class, ["as" => 'warehouse']);
    Route::resource('goodReceiptItemClassifications', Warehouse\GoodReceiptItemClassificationController::class, ["as" => 'warehouse']);
    Route::resource('sampleClassifications', Warehouse\GoodReceiptItemSampleClassificationController::class, ["as" => 'warehouse']);
});


Route::group(['prefix' => 'base'], function () {
    Route::resource('productCategories', Base\ProductCategoryController::class, ["as" => 'base']);
});
