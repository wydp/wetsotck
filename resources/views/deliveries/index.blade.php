@extends('layouts.app')
@section('title', 'Deliveries')
@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Deliveries</h1>
    <a href="{{ route('deliveries.create') }}"
       class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm font-medium">
        + Add Delivery
    </a>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Date</th>
                <th class="px-6 py-3">Supplier</th>
                <th class="px-6 py-3">Driver</th>
                <th class="px-6 py-3">Plate</th>
                <th class="px-6 py-3">Total Cost</th>
                <th class="px-6 py-3">Received By</th>
                <th class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($deliveries as $delivery)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">{{ $delivery->DeliveryID }}</td>
                <td class="px-6 py-4">{{ $delivery->DeliveryDate }}</td>
                <td class="px-6 py-4">{{ $delivery->supplier->SupplierCompany ?? 'N/A' }}</td>
                <td class="px-6 py-4">{{ $delivery->Driver }}</td>
                <td class="px-6 py-4">{{ $delivery->PlateNumber }}</td>
                <td class="px-6 py-4">₱{{ number_format($delivery->TotalCost, 2) }}</td>
                <td class="px-6 py-4">{{ $delivery->employee->FirstName ?? 'N/A' }} {{ $delivery->employee->LastName ?? '' }}</td>
                <td class="px-6 py-4 flex gap-2">
                    <a href="{{ route('deliveries.show', $delivery->DeliveryID) }}"
                       class="text-blue-600 hover:underline">View</a>
                    <form action="{{ route('deliveries.destroy', $delivery->DeliveryID) }}" method="POST"
                          onsubmit="return confirm('Delete this delivery?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-8 text-center text-gray-400">No deliveries recorded yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection