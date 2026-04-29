<?php
namespace App\Http\Controllers;

use App\Models\Tank;
use App\Models\Fuel;
use Illuminate\Http\Request;

class TankController extends Controller
{
    public function index()
    {
        $tanks = Tank::with('fuel')->get();
        return view('tanks.index', compact('tanks'));
    }

    public function create()
    {
        $fuels = Fuel::all();
        return view('tanks.create', compact('fuels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'FuelID'      => 'required|exists:fuels,FuelID',
            'MaxCapacity' => 'required|numeric|min:1',
        ]);

        Tank::create([
            'FuelID'          => $request->FuelID,
            'MaxCapacity'     => $request->MaxCapacity,
            'CurrentCapacity' => 0.00,
        ]);
        return redirect()->route('tanks.index')->with('success', 'Tank added!');
    }

    public function edit(Tank $tank)
    {
        $fuels = Fuel::all();
        return view('tanks.edit', compact('tank', 'fuels'));
    }

    public function update(Request $request, Tank $tank)
    {
        $tank->update($request->only(['FuelID', 'MaxCapacity']));
        return redirect()->route('tanks.index')->with('success', 'Tank updated!');
    }

    public function destroy(Tank $tank)
    {
        $tank->delete();
        return redirect()->route('tanks.index')->with('success', 'Tank deleted!');
    }

    public function show(Tank $tank)
    {
        $tank->load('fuel', 'deliveryDetails');
        return view('tanks.show', compact('tank'));
    }
}