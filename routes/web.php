<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\TankController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DeliveryDetailController;

// Dashboard
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Resource Routes — generates all 7 CRUD routes automatically
Route::resource('fuels', FuelController::class);
Route::resource('tanks', TankController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('deliveries', DeliveryController::class);
Route::resource('delivery-details', DeliveryDetailController::class);