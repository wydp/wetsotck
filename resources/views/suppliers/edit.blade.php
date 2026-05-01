@extends('layouts.app')
@section('title', 'Edit Supplier')
@section('content')

<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Supplier</h1>

    <form action="{{ route('suppliers.update', $supplier->SupplierID) }}" method="POST"
          class="bg-white rounded-xl shadow p-6 space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Company Name</label>
            <input type="text" name="SupplierCompany"
                value="{{ old('SupplierCompany', $supplier->SupplierCompany) }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Contact Person <span class="text-red-500">*</span></label>
            <input type="text" name="SupplierName" required
                value="{{ old('SupplierName', $supplier->SupplierName) }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Contact Number</label>
            <input type="text" name="ContactNumber" maxlength="11"
                value="{{ old('ContactNumber', $supplier->ContactNumber) }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
            <textarea name="Address" rows="2"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">{{ old('Address', $supplier->Address) }}</textarea>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 font-medium text-sm">
                Update Supplier
            </button>
            <a href="{{ route('suppliers.index') }}"
                class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 font-medium text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection