<?php

use App\Http\Controllers\Admin\BillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/mobil', [HomeController::class, 'cars'])->name('cars');
Route::get('/mobil/{id_mobil}', [HomeController::class, 'carDetail'])->name('car.detail');
Route::get('/units', [HomeController::class, 'units'])->name('units');
Route::get('/invoice', function () {
    return view('admin.invoice.invoice');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::resource('template_pesan', App\Http\Controllers\Admin\MessageTemplateController::class);
    Route::resource('faq', App\Http\Controllers\Admin\FaqController::class);
    Route::resource('snk', App\Http\Controllers\Admin\TncController::class);
    Route::resource('testimoni', App\Http\Controllers\Admin\TestimonialController::class);
    Route::resource('mobil', App\Http\Controllers\Admin\CarController::class);
    Route::resource('invoice', App\Http\Controllers\Admin\BillController::class);
    Route::get('invoice/cetak/{id_nota}', [BillController::class, 'fillPdf'])->name('invoice.print');
});