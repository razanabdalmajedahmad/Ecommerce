<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategureController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ProdactController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login_admin');
    Route::post('login', [LoginController::class, 'login_post'])->name('login_admin_post');
});
Route::get('lang/change', [LanguageController::class, 'change'])->name('changeLang');
Route::middleware('auth:admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin_home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('admin_profile');
    Route::post('/profile', [HomeController::class, 'edit_profile'])->name('edit_profile');
    Route::post('/change_password', [HomeController::class, 'change_password'])->name('change_password');


    Route::controller(CategureController::class)->prefix('Categure')->group(function () {
        Route::get('/', 'index')->name('Categure_list');
        Route::post('/', 'show')->name('Categure_list_post');
        Route::get('/createnew', 'createnew')->name('Categure_createnew');
        Route::post('/createnew', 'store')->name('Categure_createnew_post');
        Route::get('/updateCategure/{id}', 'edit')->name('Categure_update');
        Route::post('/updateCategure', 'update')->name('Categure_update_post');
        Route::post('/delete', 'delete')->name('Categure_delete');
    });
    Route::controller(ProdactController::class)->prefix('prodact')->group(function () {
        Route::get('/', 'index')->name('prodact_list');
        Route::post('/', 'show')->name('prodact_list_post');
        Route::get('/createnew', 'createnew')->name('prodact_createnew');
        Route::post('/createnew', 'store')->name('prodact_createnew_post');
        Route::get('/update/{id}', 'edit')->name('prodact_update');
        Route::post('/update', 'update')->name('prodact_update_post');
        Route::post('/delete', 'delete')->name('prodact_delete');
        Route::post('/showimage', 'showimage')->name('prodact_showimage');

    });
    Route::controller(CouponController::class)->prefix('coupon')->group(function () {
        Route::get('/', 'index')->name('coupon_list');
        Route::post('/', 'show')->name('coupon_list_post');
        Route::get('/createnew', 'createnew')->name('coupon_createnew');
        Route::post('/createnew', 'store')->name('coupon_createnew_post');
        Route::get('/update/{id}', 'edit')->name('coupon_update');
        Route::post('/update', 'update')->name('coupon_update_post');
        Route::post('/delete', 'delete')->name('coupon_delete');
    });
    Route::get('setting', [SettingController::class, 'index'])->name('setting');
    Route::post('setting', [SettingController::class, 'update'])->name('seeting.update');



});

