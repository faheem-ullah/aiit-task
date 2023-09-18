<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VehicleController;

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

Auth::routes();

// ******************** Common Routes ************************** \\
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
});

// ******************** Seller Routes ************************** \\
Route::middleware(['auth', 'can:isSeller'])->group(function () {
    Route::resource('vehicles', VehicleController::class)->except('index');
});

// ******************** Buyer Routes ************************** \\
Route::middleware(['auth', 'can:isBuyer'])->group(function () {
    Route::get('checkout/{id}', [PaymentController::class, 'index'])->name('vehicles.purchase');
    Route::post('checkout/{id}', [PaymentController::class, 'processPayment'])->name('checkout');
});
