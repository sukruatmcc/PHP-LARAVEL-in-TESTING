<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return 'about';
});

Route::get('products', [ProductController::class, 'index'])->name('product.index');
Route::get('product/create', [ProductController::class, 'create'])->middleware('admin')->name('product.create');
Route::post('product/create', [ProductController::class, 'store'])->middleware('admin')->name('product.store');
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->middleware('admin')->name('product.edit');
Route::put('product/edit/{id}', [ProductController::class, 'update'])->middleware('admin')->name('product.update');
Route::get('product/delete/{id}', [ProductController::class, 'destroy'])->middleware('admin')->name('product.destroy');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
