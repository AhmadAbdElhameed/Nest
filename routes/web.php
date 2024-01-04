<?php

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

Route::get('/', function () {
     $category = \App\Models\Category::all();
     $category->makeVisible(['translations']);

     return $category;
});
//Route::get('/admin', function () {
//    return view('layouts.admin');
//});


