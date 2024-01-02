<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::controller(AdminController::class)->group(function () {
                Route::get('/dashboard', 'index')->name('dashboard');
            });
            Route::prefix('settings')->as('settings.')->controller(SettingController::class)->group(function () {
                Route::get('/shipping-methods/{shipping}', 'editShippingMethod')->name('shipping-method');
                Route::put('/shipping-methods/{shipping}', 'updateShippingMethod')->name('shipping-method.update');
            });
            Route::get('logout',[LoginController::class,'logout'])->name('logout');
        });

        Route::group(['middleware' => 'guest:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::controller(LoginController::class)->group(function () {
                Route::get('login', 'login')->name('login');
                Route::post('login/store', 'store')->name('login.store');
            });
        });
    });








