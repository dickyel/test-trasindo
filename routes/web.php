<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RentalController;

use App\Http\Controllers\Member\RentalFormController;
use App\Http\Controllers\Member\CarController;
use App\Http\Controllers\PeminjamanController;


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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class,'authenticate'])->name('login.authenticate');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
Route::get('/rental', [RentalController::class, 'index'])->name('rental');

Route::group(['middleware' => ['auth']], function(){ 
    Route::group(['middleware' => 'can:member'], function (){
        Route::get('/rental-form', [RentalFormController::class, 'index'])->name('rental.index');
        Route::post('/rental-form/store', [RentalFormController::class, 'store'])->name('member.rental.store');

        Route::get('/car-form', [CarController::class, 'index'])->name('car-form.index');
        
        Route::get('/car-form/create', [CarController::class, 'create'])->name('car-form.create');

        Route::post('/car-form', [CarController::class, 'store'])->name('car-form.store');
        
        Route::get('/car-form/{id}', [CarController::class, 'details'])->name('car-form.detail');
        
        Route::post('/car-form/{id}', [CarController::class, 'update'])->name('car-form.update');
        
        Route::get('/car-form/delete/{id}', [CarController::class, 'destroy'])->name('car-form.destroy');

        Route::post('/car-form/cars/gallery/upload', [CarController::class,'uploadGallery'])->name('car-form.gallery-upload');

        Route::get('/car-form/cars/gallery/delete/{id}', [CarController::class,'deleteGallery'])->name('car-form.gallery-delete');

        Route::post('/peminjaman-form', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    }); 
});