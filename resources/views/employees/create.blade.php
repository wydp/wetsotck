@extends('layouts.app')
@section('title', 'Add Employee')
@section('breadcrumb', 'Staff')
@section('page-title', 'Employees')

@section('content')

<div >

    {{-- Page Header --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Add New Employee</h2>
        <p class="text-sm text-gray-400 mt-0.5">Fill in the details below to register a new staff member.</p>
    </div>

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        {{-- Section: Personal Info --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-4">
            <div class="px-6 py-3 border-b border-gray-100 bg-gray-50">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Personal Information</h3>
            </div>
            <div class="p-6 space-y-5">

                {{-- Name Row --}}
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="FirstName" value="{{ old('FirstName') }}" required
                            placeholder="e.g. Juan"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                   placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400
                                   focus:border-transparent transition-all">
                        @error('FirstName')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Middle Name</label>
                        <input type="text" name="MiddleName" value="{{ old('MiddleName') }}"
                            placeholder="Optional"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                   placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400
                                   focus:border-transparent transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="LastName" value="{{ old('LastName') }}" required
                            placeholder="e.g. Dela Cruz"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                   placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400
                                   focus:border-transparent transition-all">
                        @error('LastName')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Contact & Role Row --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Contact Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <input type="text" name="ContactNumber" value="{{ old('ContactNumber') }}"
                                placeholder="09XXXXXXXXX" maxlength="11"
                                class="w-full border border-gray-200 rounded-lg pl-10 pr-3.5 py-2.5 text-sm text-gray-800
                                       placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400
                                       focus:border-transparent transition-all font-mono">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Role <span class="text-red-500">*</span>
                        </label>
                        <select name="Role" required
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                   focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent
                                   transition-all bg-white appearance-none cursor-pointer">
                            <option value="">Select a role...</option>
                            <option value="Owner"          {{ old('Role') == 'Owner' ? 'selected' : '' }}>Owner</option>
                            <option value="Admin"          {{ old('Role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Fuel Attendant" {{ old('Role') == 'Fuel Attendant' ? 'selected' : '' }}>Fuel Attendant</option>
                            <option value="Cashier"        {{ old('Role') == 'Cashier' ? 'selected' : '' }}>Cashier</option>
                        </select>
                    </div>
                </div>

                {{-- Address --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Address</label>
                    <textarea name="Address" rows="2" placeholder="Street, Barangay, City, Province"
                        class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                               placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400
                               focus:border-transparent transition-all resize-none">{{ old('Address') }}</textarea>
                </div>

            </div>
        </div>

        {{-- Section: Status --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-6">
            <div class="px-6 py-3 border-b border-gray-100 bg-gray-50">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</h3>
            </div>
            <div class="px-6 py-4">
                <label class="flex items-center gap-3 cursor-pointer group w-fit">
                    <input type="checkbox" name="IsActive" value="1" id="isActive"
                        {{ old('IsActive', '1') ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-gray-300 text-red-600 focus:ring-red-400 cursor-pointer">
                    <div>
                        <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900 transition-colors">
                            Active Employee
                        </p>
                        <p class="text-xs text-gray-400">Employee will appear as active and can be assigned to deliveries</p>
                    </div>
                </label>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-2.5 rounded-lg hover:bg-red-700
                       font-medium text-sm transition-colors shadow-sm">
                Save Employee
            </button>
            <a href="{{ route('employees.index') }}"
                class="bg-white border border-gray-200 text-gray-600 px-6 py-2.5 rounded-lg
                       hover:bg-gray-50 font-medium text-sm transition-colors">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection