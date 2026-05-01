@extends('layouts.app')
@section('title', 'Employees')
@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Employees</h1>
    <a href="{{ route('employees.create') }}"
       class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm font-medium">
        + Add Employee
    </a>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-6 py-3">Name</th>
                <th class="px-6 py-3">Contact</th>
                <th class="px-6 py-3">Address</th>
                <th class="px-6 py-3">Role</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($employees as $employee)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">
                    {{ $employee->FirstName }}
                    {{ $employee->MiddleName ? $employee->MiddleName . ' ' : '' }}
                    {{ $employee->LastName }}
                </td>
                <td class="px-6 py-4">{{ $employee->ContactNumber ?? '—' }}</td>
                <td class="px-6 py-4">{{ $employee->Address ?? '—' }}</td>
                <td class="px-6 py-4">{{ $employee->Role }}</td>
                <td class="px-6 py-4">
                    @if($employee->IsActive)
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Active</span>
                    @else
                        <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded-full text-xs">Inactive</span>
                    @endif
                </td>
                <td class="px-6 py-4 flex gap-3">
                    <a href="{{ route('employees.edit', $employee->EmployeeID) }}"
                       class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->EmployeeID) }}"
                          method="POST"
                          onsubmit="return confirm('Deactivate this employee?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Deactivate</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-400">No employees found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection