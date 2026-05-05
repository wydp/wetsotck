<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\TankController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DeliveryDetailController;

Route::get('/', function () {
    $recentDeliveries = \App\Models\Delivery::with(['supplier', 'employee'])
        ->orderBy('DeliveryDate', 'desc')
        ->limit(10)
        ->get();

    $tanks = \App\Models\Tank::with('fuel')->get();

    return view('dashboard', compact('recentDeliveries', 'tanks'));
})->name('dashboard');

// Resource Routes — generates all 7 CRUD routes automatically
Route::resource('fuels', FuelController::class);
Route::resource('tanks', TankController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('deliveries', DeliveryController::class);
Route::resource('delivery-details', DeliveryDetailController::class);

Route::post('suppliers/{supplier}/restore', function(\App\Models\Supplier $supplier) {
    $supplier->restore();
    return redirect()->route('suppliers.index')->with('success', 'Supplier restored!');
})->name('suppliers.restore')->withTrashed();

Route::post('employees/{employee}/toggle', function(\App\Models\Employee $employee) {
    $employee->IsActive = !$employee->IsActive;
    $employee->save();
    
    $status = $employee->IsActive ? 'activated' : 'deactivated';
    return redirect()->route('employees.index')
        ->with('success', "Employee {$status} successfully.");
})->name('employees.toggle');