@extends('layouts.app')
@section('title', 'Edit Supplier')
@section('breadcrumb', 'Suppliers')
@section('page-title', 'Edit Supplier')

@section('content')

<form action="{{ route('suppliers.update', $supplier->SupplierID) }}" method="POST">
@csrf @method('PUT')

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
        <div>
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Edit Supplier</h2>
            <p class="text-xs text-gray-400 mt-0.5">{{ $supplier->SupplierCompany ?? $supplier->SupplierName }}</p>
        </div>
        {{-- Status badge --}}
        @if(is_null($supplier->deleted_at))
            <span class="bg-green-50 text-green-700 text-xs font-medium px-2.5 py-1 rounded-full">Active</span>
        @else
            <span class="bg-gray-100 text-gray-500 text-xs font-medium px-2.5 py-1 rounded-full">Archived</span>
        @endif
    </div>

    <div class="p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Company Name</label>
                <input type="text" name="SupplierCompany"
                    value="{{ old('SupplierCompany', $supplier->SupplierCompany) }}"
                    placeholder="e.g. Petron Corporation"
                    class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-700
                           focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Contact Person <span class="text-red-500">*</span>
                </label>
                <input type="text" name="SupplierName" required
                    value="{{ old('SupplierName', $supplier->SupplierName) }}"
                    class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-700
                           focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Contact Number</label>
                <input type="text" name="ContactNumber" maxlength="11"
                    value="{{ old('ContactNumber', $supplier->ContactNumber) }}"
                    class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-700
                           font-mono focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Address</label>
                <input type="text" name="Address"
                    value="{{ old('Address', $supplier->Address) }}"
                    placeholder="Business address"
                    class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-700
                           focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
            </div>

        </div>
    </div>

    <div class="px-8 py-5 border-t border-gray-100 bg-gray-50 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-2.5 rounded-lg hover:bg-red-700 font-semibold text-sm
                       transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Update Supplier
            </button>
            <a href="{{ route('suppliers.index') }}"
                class="bg-white text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-50 font-semibold text-sm
                       transition-colors border border-gray-200">
                Cancel
            </a>
        </div>

        {{-- Soft Delete / Restore --}}
        @if(is_null($supplier->deleted_at))
        <form action="{{ route('suppliers.destroy', $supplier->SupplierID) }}" method="POST"
              onsubmit="return confirm('Archive this supplier? They will no longer appear in active lists but their delivery records will be preserved.')">
            @csrf @method('DELETE')
            <button type="submit"
                class="flex items-center gap-2 text-gray-400 hover:text-red-600 text-sm font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
                Archive Supplier
            </button>
        </form>
        @else
        <form action="{{ route('suppliers.restore', $supplier->SupplierID) }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center gap-2 text-gray-400 hover:text-green-600 text-sm font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Restore Supplier
            </button>
        </form>
        @endif
    </div>
</div>

</form>

@endsection