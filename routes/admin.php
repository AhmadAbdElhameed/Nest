<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ProductController;
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
            Route::prefix('profile')->as('profile.')->controller(ProfileController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::put('/update/{admin}', 'update')->name('update');
            });
            Route::get('logout',[LoginController::class,'logout'])->name('logout');

            ################################## Categories Routes ####################################
            Route::prefix('category')->as('category.')->controller(CategoryController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{category}', 'edit')->name('edit');
                Route::put('update/{category}', 'update')->name('update');
                Route::get('delete/{category}', 'destroy')->name('delete');
            });
            ################################## end categories Routes #######################################

            ################################## Sub Categories Routes ####################################
            Route::prefix('sub-category')->as('sub-category.')->controller(SubCategoryController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{subCategory}', 'edit')->name('edit');
                Route::put('update/{subCategory}', 'update')->name('update');
                Route::get('delete/{subCategory}', 'destroy')->name('delete');
            });
            ################################## end Sub Categories Routes #######################################


            ################################## Brands Routes ####################################
            Route::prefix('brand')->as('brand.')->controller(BrandController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{brand}', 'edit')->name('edit');
                Route::put('update/{brand}', 'update')->name('update');
                Route::get('delete/{brand}', 'destroy')->name('delete');
            });
            ################################## Brands Routes #######################################


            ################################## Tags Routes ####################################
            Route::prefix('tag')->as('tag.')->controller(TagController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{tag}', 'edit')->name('edit');
                Route::put('update/{tag}', 'update')->name('update');
                Route::get('delete/{tag}', 'destroy')->name('delete');
            });
            ################################## Tags Routes #######################################



            ################################## Products Routes ####################################
            Route::prefix('product')->as('product.')->controller(ProductController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{product}', 'edit')->name('edit');
                Route::put('update/{product}', 'update')->name('update');
                Route::get('delete/{product}', 'destroy')->name('delete');


                Route::get('get-price/{product}', 'getPrice')->name('price');
                Route::put('update-price/{product}', 'updatePrice')->name('price.update');

            });
            ################################## Products Routes #######################################

        });

        Route::group(['middleware' => 'guest:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::controller(LoginController::class)->group(function () {
                Route::get('login', 'login')->name('login');
                Route::post('login/store', 'store')->name('login.store');
            });
        });
    });








