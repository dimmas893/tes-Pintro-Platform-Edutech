<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BE\UserController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('user')->group(function () {
    Route::get('/all', [UserController::class, 'all'])->name('user-all');
    Route::get('/address', [UserController::class, 'addressAll'])->name('user-address');
    Route::get('/manyToMany', [UserController::class, 'manytomanyAll'])->name('user-manytomanyAll');
    Route::get('/one-to-one', [UserController::class, 'index'])->name('oneToOne');
    Route::get('/one-to-many', [UserController::class, 'address'])->name('oneToMany');
    Route::get('/many-to-many', [UserController::class, 'manytomany'])->name('manytomany');
});

require __DIR__ . '/auth.php';
