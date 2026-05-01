<?php
namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\DeliveryDetail;
use App\Models\Supplier;
use App\Models\Employee;
use App\Models\Tank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    // Show list of all deliveries
    public function index()
    {
        $deliveries = Delivery::with(['supplier', 'employee'])
            ->orderBy('DeliveryDate', 'desc')
            ->get();
        return view('deliveries.index', compact('deliveries'));
    }

    // Show the Add Delivery form
    public function create()
    {
        $suppliers = Supplier::all();
        $employees = Employee::where('IsActive', true)->get();
        $tanks     = Tank::with('fuel')->get();
        return view('deliveries.create', compact('suppliers', 'employees', 'tanks'));
    }

    // Save the new delivery
    public function store(Request $request)
    {
        $request->validate([
            'SupplierID'    => 'required|exists:suppliers,SupplierID',
            'SupplierName'  => 'required|string|max:100',  // ← added
            'Driver'        => 'required|string|max:100',
            'PlateNumber'   => 'required|string|max:20',
            'EmployeeID'    => 'required|exists:employees,EmployeeID',
            'DeliveryDate'  => 'required|date',
            'details'       => 'required|array|min:1',
            'details.*.TankID'    => 'required|exists:tanks,TankID',
            'details.*.Quantity'  => 'required|numeric|min:0.01',
            'details.*.UnitCost'  => 'required|numeric|min:0.01',
        ]);

        // Use DB transaction — if anything fails, rollback everything
        DB::transaction(function () use ($request) {

            // Step 1: Create the delivery header
            $delivery = Delivery::create([
                'SupplierID'   => $request->SupplierID,
                'SupplierName' => $request->SupplierName,  // ← added
                'Driver'       => $request->Driver,
                'PlateNumber'  => $request->PlateNumber,
                'EmployeeID'   => $request->EmployeeID,
                'DeliveryDate' => $request->DeliveryDate,
                'TotalCost'    => 0, // temporary, updated below
            ]);

            $totalCost = 0;

            // Step 2: Create each detail row
            foreach ($request->details as $detail) {
                $subtotal = $detail['Quantity'] * $detail['UnitCost'];

                DeliveryDetail::create([
                    'DeliveryID' => $delivery->DeliveryID,
                    'TankID'     => $detail['TankID'],
                    'Quantity'   => $detail['Quantity'],
                    'UnitCost'   => $detail['UnitCost'],
                    'Subtotal'   => $subtotal,
                ]);

                // Step 3: Update tank's CurrentCapacity
                $tank = Tank::find($detail['TankID']);
                $tank->CurrentCapacity += $detail['Quantity'];
                $tank->save();

                $totalCost += $subtotal;
            }

            // Step 4: Update delivery's TotalCost
            $delivery->TotalCost = $totalCost;
            $delivery->save();
        });

        return redirect()->route('deliveries.index')
            ->with('success', 'Delivery recorded successfully!');
    }

    // Show one delivery with its details
    public function show(Delivery $delivery)
    {
        $delivery->load(['supplier', 'employee', 'deliveryDetails.tank.fuel']);
        return view('deliveries.show', compact('delivery'));
    }

    // Show edit form
    public function edit(Delivery $delivery)
    {
        $suppliers = Supplier::all();
        $employees = Employee::where('IsActive', true)->get();
        $tanks     = Tank::with('fuel')->get();
        $delivery->load('deliveryDetails');
        return view('deliveries.edit', compact('delivery', 'suppliers', 'employees', 'tanks'));
    }

    // Save edits
    public function update(Request $request, Delivery $delivery)
    {
        $delivery->update($request->only([
            'SupplierID', 'Driver', 'PlateNumber', 'EmployeeID', 'DeliveryDate'
        ]));
        return redirect()->route('deliveries.index')
            ->with('success', 'Delivery updated successfully!');
    }

    // Delete a delivery
    public function destroy(Delivery $delivery)
    {
        $delivery->delete(); // cascade deletes details automatically
        return redirect()->route('deliveries.index')
            ->with('success', 'Delivery deleted successfully!');
    }
}