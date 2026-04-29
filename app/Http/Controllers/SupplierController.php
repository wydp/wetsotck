<?php
namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'SupplierName'    => 'required|string|max:100',
            'SupplierCompany' => 'nullable|string|max:100',
            'ContactNumber'   => 'nullable|string|max:11',
        ]);

        Supplier::create($request->only(['SupplierCompany', 'SupplierName', 'ContactNumber']));
        return redirect()->route('suppliers.index')->with('success', 'Supplier added!');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update($request->only(['SupplierCompany', 'SupplierName', 'ContactNumber']));
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted!');
    }

    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }
}