<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuratmasukController;

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

Route::get('/',[LandingController::class,'index']);
Route::get('/home',[HomeController::class,'index']);

Route::resource('suratmasuks',SuratmasukController::class);

Route::get('suratmasukimport',[SuratmasukController::class,'import']);
Route::post('suratmasukimportproses',[SuratmasukController::class,'importproses']);
Route::get('suratmasukpdf',[SuratmasukController::class,'exportpdf']);