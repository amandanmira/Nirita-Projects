<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{any}', function () {
    return view('welcome'); // ganti 'app' sesuai nama blade kamu
})->where('any', '.*');
