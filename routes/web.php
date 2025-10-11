<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\MessageTemplateController;
use App\Http\Controllers\Admin\FaqController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });

    Route::resource('template_pesan', MessageTemplateController::class);
    Route::resource('faq', FaqController::class);
});
