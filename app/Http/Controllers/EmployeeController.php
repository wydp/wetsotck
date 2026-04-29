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
            'FirstName'     => 'required|string|max:50',
            'LastName'      => 'required|string|max:50',
            'ContactNumber' => 'nullable|string|max:11',
            'Role'          => 'required|string|max:50',
        ]);

        Employee::create($request->only(['FirstName', 'LastName', 'ContactNumber', 'Role', 'IsActive']));
        return redirect()->route('employees.index')->with('success', 'Employee added!');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->only(['FirstName', 'LastName', 'ContactNumber', 'Role', 'IsActive']));
        return redirect()->route('employees.index')->with('success', 'Employee updated!');
    }

    public function destroy(Employee $employee)
    {
        $employee->IsActive = false;
        $employee->save();
        return redirect()->route('employees.index')->with('success', 'Employee deactivated!');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }
}