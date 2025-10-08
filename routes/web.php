<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\MessageTemplateController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('admin/template_pesan', MessageTemplateController::class);
