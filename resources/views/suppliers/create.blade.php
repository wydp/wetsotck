@extends('layouts.app')
@section('title', 'Add Supplier')
@section('breadcrumb', 'Suppliers')
@section('page-title', 'Add Supplier')

@section('content')

<form action="{{ route('suppliers.store') }}" method="POST">
@csrf

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50">
        <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Supplier Information</h2>
        <p class="text-xs text-gray-400 mt-0.5">Fill in the details for the new supplier</p>
    </div>

    <div class="p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Company Name
                </label>
                <input type="text" name="SupplierCompany" value="{{ old('SupplierCompany') }}"
                    placeholder="e.g. Petron Corporation"
                    class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-700
                           focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                @error('SupplierCompany')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Contact Person <span class="text-red-500">*</span>
                </label>
                <input type="text" name="SupplierName" value="{{ old('SupplierName') }}" required
                    placeholder="e.g. Ramon Dela Cruz"
                    class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-700
                           focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                @error('SupplierName')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Contact Number
                </label>
                <input type="text" name="ContactNumber" value="{{ old('ContactNumber') }}"
                    placeholder="09XXXXXXXXX" maxlength="11"
                    class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-700
                           font-mono focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                @error('ContactNumber')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Address
                </label>
                <input type="text" name="Address" value="{{ old('Address') }}"
                    placeholder="Business address"
                    class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-700
                           focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
            </div>

        </div>
    </div>

    <div class="px-8 py-5 border-t border-gray-100 bg-gray-50 flex items-center gap-3">
        <button type="submit"
            class="bg-red-600 text-white px-6 py-2.5 rounded-lg hover:bg-red-700 font-semibold text-sm
                   transition-colors shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Save Supplier
        </button>
        <a href="{{ route('suppliers.index') }}"
            class="bg-white text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-50 font-semibold text-sm
                   transition-colors border border-gray-200">
            Cancel
        </a>
    </div>
</div>

</form>

@endsection