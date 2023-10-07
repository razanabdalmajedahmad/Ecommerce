<?php

use App\Http\Controllers\User\HomeController;
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


Auth::routes();
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('filter_categure', 'filter_categure')->name('filter_categure');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
