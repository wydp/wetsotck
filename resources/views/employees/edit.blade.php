@extends('layouts.app')
@section('title', 'Edit Employee')
@section('breadcrumb', 'Staff')
@section('page-title', 'Employees')

@section('content')

<div>

    {{-- Page Header --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Edit Employee</h2>
        <p class="text-sm text-gray-400 mt-0.5">
            {{ $employee->FirstName }} {{ $employee->LastName }}
        </p>
    </div>

    <form action="{{ route('employees.update', $employee->EmployeeID) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Personal Info --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-4">
            <div class="px-6 py-3 border-b border-gray-100 bg-gray-50">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Personal Information
                </h3>
            </div>

            <div class="p-6 space-y-5">

                {{-- Name --}}
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            First Name *
                        </label>
                        <input type="text" name="FirstName"
                            value="{{ old('FirstName', $employee->FirstName) }}" required
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Middle Name
                        </label>
                        <input type="text" name="MiddleName"
                            value="{{ old('MiddleName', $employee->MiddleName) }}"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Last Name *
                        </label>
                        <input type="text" name="LastName"
                            value="{{ old('LastName', $employee->LastName) }}" required
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm">
                    </div>
                </div>

                {{-- Contact + Role --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Contact Number
                        </label>
                        <input type="text" name="ContactNumber"
                            value="{{ old('ContactNumber', $employee->ContactNumber) }}"
                            maxlength="11"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Role *
                        </label>
                        <select name="Role" required
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm">
                            
                            <option value="">Select role...</option>
                            <option value="Owner" {{ $employee->Role == 'Owner' ? 'selected' : '' }}>Owner</option>
                            <option value="Admin" {{ $employee->Role == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Fuel Attendant" {{ $employee->Role == 'Fuel Attendant' ? 'selected' : '' }}>Fuel Attendant</option>
                            <option value="Cashier" {{ $employee->Role == 'Cashier' ? 'selected' : '' }}>Cashier</option>
                        </select>
                    </div>
                </div>

                {{-- Address --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Address
                    </label>
                    <textarea name="Address" rows="2"
                        class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm">{{ old('Address', $employee->Address) }}</textarea>
                </div>

            </div>
        </div>

        {{-- Status --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-6">
            <div class="px-6 py-3 border-b border-gray-100 bg-gray-50">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</h3>
            </div>

            <div class="px-6 py-4">
                <label class="flex items-center gap-3">
                    <input type="checkbox" name="IsActive" value="1"
                        {{ $employee->IsActive ? 'checked' : '' }}>
                    <span class="text-sm text-gray-700">Active Employee</span>
                </label>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-2.5 rounded-lg">
                Update Employee
            </button>

            <a href="{{ route('employees.index') }}"
                class="bg-white border px-6 py-2.5 rounded-lg">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection