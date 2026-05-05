@extends('layouts.app')
@section('title', 'Edit Supplier')
@section('breadcrumb', 'Stock-In')
@section('page-title', 'Suppliers')

@section('content')

<div>
    <div class="mb-6 flex items-start justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Edit Supplier</h2>
            <p class="text-sm text-gray-400 mt-0.5">{{ $supplier->SupplierCompany ?? $supplier->SupplierName }}</p>
        </div>
        @if(is_null($supplier->deleted_at))
            <span class="bg-green-50 text-green-700 text-xs font-medium px-2.5 py-1 rounded-full">Active</span>
        @else
            <span class="bg-gray-100 text-gray-500 text-xs font-medium px-2.5 py-1 rounded-full">Archived</span>
        @endif
    </div>

    <form action="{{ route('suppliers.update', $supplier->SupplierID) }}" method="POST">
        @csrf @method('PUT')

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-6">
            <div class="px-6 py-3 border-b border-gray-100 bg-gray-50">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Supplier Information</h3>
            </div>
            <div class="p-6 space-y-5">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Company Name</label>
                        <input type="text" name="SupplierCompany"
                            value="{{ old('SupplierCompany', $supplier->SupplierCompany) }}"
                            placeholder="e.g. Petron Corporation"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                   placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Contact Person <span class="text-red-500">*</span></label>
                        <input type="text" name="SupplierName" required
                            value="{{ old('SupplierName', $supplier->SupplierName) }}"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                   placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
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
                            <input type="text" name="ContactNumber" maxlength="11"
                                value="{{ old('ContactNumber', $supplier->ContactNumber) }}"
                                placeholder="09XXXXXXXXX"
                                class="w-full border border-gray-200 rounded-lg pl-10 pr-3.5 py-2.5 text-sm text-gray-800
                                       placeholder-gray-300 font-mono focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Address</label>
                        <input type="text" name="Address"
                            value="{{ old('Address', $supplier->Address) }}"
                            placeholder="Business address"
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                   placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                    </div>
                </div>

            </div>
        </div>

        {{-- Actions + Archive/Restore --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button type="submit"
                    class="bg-red-600 text-white px-6 py-2.5 rounded-lg hover:bg-red-700 font-medium text-sm transition-colors shadow-sm">
                    Update Supplier
                </button>
                <a href="{{ route('suppliers.index') }}"
                    class="bg-white border border-gray-200 text-gray-600 px-6 py-2.5 rounded-lg hover:bg-gray-50 font-medium text-sm transition-colors">
                    Cancel
                </a>
            </div>

            @if(is_null($supplier->deleted_at))
            <form action="{{ route('suppliers.destroy', $supplier->SupplierID) }}" method="POST"
                  onsubmit="return confirm('Archive this supplier? Their delivery records will be preserved.')">
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

    </form>
</div>

@endsection