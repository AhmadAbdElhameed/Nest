<?php

use App\Http\Controllers\Admin\LoginController;
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

Route::group(['middleware' => 'auth:admin' , 'prefix' => 'admin' , 'name' => 'admin.'],function (){

});

Route::get('/admin/dashboard',function (){
    return "Hello Admin";
})->name('admin.dashboard');

Route::group(['prefix' => 'admin'],function (){
    Route::get('login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('login/store', [LoginController::class, 'store'])->name('admin.login.store');
});

