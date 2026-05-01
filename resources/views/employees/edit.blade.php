@extends('layouts.app')
@section('title', 'Edit Employee')
@section('content')

<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Employee</h1>

    <form action="{{ route('employees.update', $employee->EmployeeID) }}" method="POST"
          class="bg-white rounded-xl shadow p-6 space-y-4">
        @csrf @method('PUT')

        <div class="grid grid-cols-3 gap-3">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">First Name <span class="text-red-500">*</span></label>
                <input type="text" name="FirstName" required
                    value="{{ old('FirstName', $employee->FirstName) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Middle Name</label>
                <input type="text" name="MiddleName"
                    value="{{ old('MiddleName', $employee->MiddleName) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Last Name <span class="text-red-500">*</span></label>
                <input type="text" name="LastName" required
                    value="{{ old('LastName', $employee->LastName) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Contact Number</label>
            <input type="text" name="ContactNumber" maxlength="11"
                value="{{ old('ContactNumber', $employee->ContactNumber) }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
            <textarea name="Address" rows="2"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">{{ old('Address', $employee->Address) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Role <span class="text-red-500">*</span></label>
            <select name="Role" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
                <option value="Owner"          {{ old('Role', $employee->Role) == 'Owner' ? 'selected' : '' }}>Owner</option>
                <option value="Admin"          {{ old('Role', $employee->Role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Fuel Attendant" {{ old('Role', $employee->Role) == 'Fuel Attendant' ? 'selected' : '' }}>Fuel Attendant</option>
                <option value="Cashier"        {{ old('Role', $employee->Role) == 'Cashier' ? 'selected' : '' }}>Cashier</option>
            </select>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="IsActive" value="1" id="isActive"
                {{ old('IsActive', $employee->IsActive) ? 'checked' : '' }}
                class="rounded border-gray-300 text-red-600">
            <label for="isActive" class="text-sm text-gray-600">Active Employee</label>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 font-medium text-sm">
                Update Employee
            </button>
            <a href="{{ route('employees.index') }}"
                class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 font-medium text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection