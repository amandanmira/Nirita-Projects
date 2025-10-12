<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\MessageTemplateController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CarController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });

    Route::resource('template_pesan', MessageTemplateController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('testimoni', TestimonialController::class);
    Route::resource('mobil', CarController::class);
});
