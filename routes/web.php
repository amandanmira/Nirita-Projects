<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Home');
});

// Route::get('/{any}', function () {
//     return view('welcome'); // ganti 'app' sesuai nama blade kamu
// })->where('any', '.*');
