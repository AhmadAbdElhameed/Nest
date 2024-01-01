<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:admin' , 'prefix' => 'admin' ,'as' => 'admin.'  ],function (){
    Route::controller(AdminController::class)->group(function (){
        Route::get('/dashboard','index')->name('dashboard');
    });

    Route::prefix('settings')->as('settings.')->controller(SettingController::class)->group(function () {
        Route::get('/shipping-methods/{Shipping}', 'editShippingMethod')->name('shipping-methods');
    });

});

Route::group(['middleware' => 'guest:admin' , 'prefix' => 'admin' ,'as' => 'admin.'  ],function (){
    Route::controller(LoginController::class)->group(function (){
        Route::get('login', 'login')->name('login');
        Route::post('login/store', 'store')->name('login.store');
    });
});





