<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/mobil', [HomeController::class, 'cars'])->name('cars');
Route::get('/mobil/{id_mobil}', [HomeController::class, 'carDetail'])->name('car.detail');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() {
        return view('admin.index');
    });
    Route::resource('template_pesan', App\Http\Controllers\Admin\MessageTemplateController::class);
    Route::resource('faq', App\Http\Controllers\Admin\FaqController::class);
    Route::resource('testimoni', App\Http\Controllers\Admin\TestimonialController::class);
    Route::resource('mobil', App\Http\Controllers\Admin\CarController::class);
});