<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/gallery','App\Http\Controllers\HomeController@gallery');
Route::post('/gallery','App\Http\Controllers\GalleryController@store');
Route::get('/getAuthId','App\Http\Controllers\HomeController@getAuthId');
Route::get('/getImages','App\Http\Controllers\HomeController@getImages');
Route::delete('/gallery/{id}','App\Http\Controllers\HomeController@deleteImage');
