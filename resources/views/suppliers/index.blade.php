@extends('layouts.app')
@section('title', 'Suppliers')
@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Suppliers</h1>
    <a href="{{ route('suppliers.create') }}"
       class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm font-medium">
        + Add Supplier
    </a>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-6 py-3">Company</th>
                <th class="px-6 py-3">Contact Person</th>
                <th class="px-6 py-3">Contact Number</th>
                <th class="px-6 py-3">Address</th>
                <th class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($suppliers as $supplier)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $supplier->SupplierCompany ?? '—' }}</td>
                <td class="px-6 py-4">{{ $supplier->SupplierName }}</td>
                <td class="px-6 py-4">{{ $supplier->ContactNumber ?? '—' }}</td>
                <td class="px-6 py-4">{{ $supplier->Address ?? '—' }}</td>
                <td class="px-6 py-4 flex gap-3">
                    <a href="{{ route('suppliers.edit', $supplier->SupplierID) }}"
                       class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('suppliers.destroy', $supplier->SupplierID) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this supplier?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-400">No suppliers found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection