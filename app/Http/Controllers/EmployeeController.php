<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|string|max:50',
            'LastName'  => 'required|string|max:50',
            'Role'      => 'required|string|max:50',
        ]);

        Employee::create([
            'FirstName'     => $request->FirstName,
            'MiddleName'    => $request->MiddleName,
            'LastName'      => $request->LastName,
            'ContactNumber' => $request->ContactNumber,
            'Address'       => $request->Address,
            'Role'          => $request->Role,
            'IsActive'      => $request->has('IsActive') ? 1 : 0,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee added!');
    }


    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
{
    $employee->update([
        'FirstName'     => $request->FirstName,
        'MiddleName'    => $request->MiddleName,
        'LastName'      => $request->LastName,
        'ContactNumber' => $request->ContactNumber,
        'Address'       => $request->Address,
        'Role'          => $request->Role,
        'IsActive'      => $request->has('IsActive') ? 1 : 0,
        // $request->has('IsActive') → true if checkbox was checked
        // If not checked → sends 0 (inactive)
    ]);
    return redirect()->route('employees.index')->with('success', 'Employee updated!');
}


    public function destroy(Employee $employee)
    {
        $employee->delete();
        // Note: this archives — different from deactivating (IsActive)
        // Archiving = soft delete, Deactivating = IsActive = false
        return redirect()->route('employees.index')
            ->with('success', 'Employee archived.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }
}