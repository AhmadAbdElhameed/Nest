<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\WishlistController;
use App\Http\Controllers\ProfileController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::group([],function () {
            Route::get('/',[HomeController::class,'home'])->name('home');
            Route::get('/category/{category}',[HomeController::class,'category'])->name('category');
            Route::get('/product/{product}',[HomeController::class,'productDetails'])->name('product_details');
            Route::get('/product-details/{id}', [HomeController::class,'showModalContent'])->name('get-product-details');
            Route::post('verify-phone', [RegisteredUserController::class, 'verifyOTP'])->name('register.verify.phone');
        });

        Route::middleware('auth')->group(function () {
            Route::post('wishlist', [WishlistController::class,'store'])->name('wishlist.store');
            Route::delete('wishlist/{product_id}', [WishlistController::class,'destroy'])->name('wishlist.destroy');
            Route::get('wishlist/products', [WishlistController::class,'index'])->name('wishlist.index');
            Route::get('/wishlist/count', [WishlistController::class, 'count'])->name('wishlist.count');


            Route::group(['prefix' => 'cart', 'as' => 'cart.'], function() {
                Route::get('/', [CartController::class, 'index'])->name('index');
                Route::post('/add', [CartController::class, 'addToCart'])->name('add'); // Changed to '/add'
                Route::get('/count', [CartController::class, 'cartCount'])->name('count');

                Route::delete('/remove', [CartController::class, 'removeFromCart'])->name('remove');
                Route::post('/update', [CartController::class, 'updateCart'])->name('update');

            });
        });



    }
);


require __DIR__.'/auth.php';
