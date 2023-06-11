<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\InwardController;
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

Route::get('/', function () { return view('layout'); });
Route::resource('category', CategoryController::class);
Route::get('/material/{id}/inwards', [InwardController::class, 'showList'])->name('materialInwardsList');
Route::resource('material', MaterialController::class);
Route::resource('inwards', InwardController::class);
Route::post('/balance', [InwardController::class, 'getBalance']);