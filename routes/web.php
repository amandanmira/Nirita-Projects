<?php

use Inertia\Inertia;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return Inertia::render('Home');
});

// Route::get('/{any}', function () {
//     return view('welcome'); // ganti 'app' sesuai nama blade kamu
// })->where('any', '.*');
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/mobil', [HomeController::class, 'cars'])->name('cars');
Route::get('/mobil/{id_mobil}', [HomeController::class, 'carDetail'])->name('car.detail');
Route::get('/units', [HomeController::class, 'units'])->name('units');
Route::get('/syarat-ketentuan', [HomeController::class, 'tnc'])->name('tnc');
Route::get('/invoice-test', function () {
    return view('admin.invoice.invoice');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
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

require __DIR__ . '/auth.php';
