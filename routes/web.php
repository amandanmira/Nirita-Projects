<?php

use Inertia\Inertia;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return Inertia::render('Home');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/mobil', [HomeController::class, 'cars'])->name('cars');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/units', [HomeController::class, 'units'])->name('units');
Route::get('/units/{id_mobil}', [HomeController::class, 'unitsDetail'])->name('units.detail');
Route::get('/review', [HomeController::class, 'review'])->name('review');
Route::get('/tnc', [HomeController::class, 'tnc'])->name('tnc');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/invoice-test', function () {
    return view('admin.invoice.invoice');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', function () {
    return Inertia::render('Login');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Layouts/DashboardLayouts');
    })->name('dashboard');
    Route::resource('template-pesan', App\Http\Controllers\Admin\MessageTemplateController::class);
    Route::resource('faq', App\Http\Controllers\Admin\FaqController::class);
    Route::resource('snk', App\Http\Controllers\Admin\TncController::class);
    Route::resource('testimoni', App\Http\Controllers\Admin\TestimonialController::class);
    Route::resource('mobil', App\Http\Controllers\Admin\CarController::class);
    Route::resource('invoice', App\Http\Controllers\Admin\BillController::class);
    Route::get('/invoice/{id_nota}/pdf', [BillController::class, 'fillPdf'])->name('invoice.pdf');
});

// Route::get('/{any}', function () {
//     return view('welcome'); // ganti 'app' sesuai nama blade kamu
// })->where('any', '.*');
/*Route::get('/', function () {
    return view('welcome');
});*/

require __DIR__ . '/auth.php';
