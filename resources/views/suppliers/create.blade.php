@extends('layouts.app')
@section('title', 'Add Supplier')
@section('breadcrumb', 'Stock-In')
@section('page-title', 'Suppliers')

@section('content')

<div>
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Add New Supplier</h2>
        <p class="text-sm text-gray-400 mt-0.5">Fill in the details below to register a new supplier.</p>
    </div>

    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-6">
            <div class="px-6 py-3 border-b border-gray-100 bg-gray-50">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Supplier Information</h3>
            </div>
            <div class="p-6 space-y-5">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Company Name</label>
                        <input type="text" name="SupplierCompany" value="{{ old('SupplierCompany') }}"
                            placeholder="e.g. Petron Corporation"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                   placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                        @error('SupplierCompany')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Contact Person <span class="text-red-500">*</span></label>
                        <input type="text" name="SupplierName" value="{{ old('SupplierName') }}" required
                            placeholder="e.g. Ramon Dela Cruz"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                   placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                        @error('SupplierName')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

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
                                       placeholder-gray-300 font-mono focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                        </div>
                        @error('ContactNumber')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Address</label>
                        <input type="text" name="Address" value="{{ old('Address') }}"
                            placeholder="Business address"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                   placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                    </div>
                </div>

            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-2.5 rounded-lg hover:bg-red-700 font-medium text-sm transition-colors shadow-sm">
                Save Supplier
            </button>
            <a href="{{ route('suppliers.index') }}"
                class="bg-white border border-gray-200 text-gray-600 px-6 py-2.5 rounded-lg hover:bg-gray-50 font-medium text-sm transition-colors">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection