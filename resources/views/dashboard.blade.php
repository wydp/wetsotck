@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="{{ route('deliveries.index') }}"
       class="bg-white rounded-xl shadow p-6 hover:shadow-md transition">
        <p class="text-gray-500 text-sm">Total Deliveries</p>
        <p class="text-3xl font-bold text-red-600 mt-1">
            {{ \App\Models\Delivery::count() }}
        </p>
    </a>
    <a href="{{ route('suppliers.index') }}"
       class="bg-white rounded-xl shadow p-6 hover:shadow-md transition">
        <p class="text-gray-500 text-sm">Suppliers</p>
        <p class="text-3xl font-bold text-red-600 mt-1">
            {{ \App\Models\Supplier::count() }}
        </p>
    </a>
    <a href="{{ route('tanks.index') }}"
       class="bg-white rounded-xl shadow p-6 hover:shadow-md transition">
        <p class="text-gray-500 text-sm">Tanks</p>
        <p class="text-3xl font-bold text-red-600 mt-1">
            {{ \App\Models\Tank::count() }}
        </p>
    </a>
</div>

{{-- Tank Stock Levels --}}
<div class="mt-8 bg-white rounded-xl shadow p-6">
    <h2 class="text-lg font-semibold text-gray-700 mb-4">Current Tank Levels</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach(\App\Models\Tank::with('fuel')->get() as $tank)
        @php $pct = $tank->MaxCapacity > 0 ? ($tank->CurrentCapacity / $tank->MaxCapacity) * 100 : 0; @endphp
        <div class="border rounded-lg p-4">
            <p class="font-semibold text-gray-700">{{ $tank->fuel->FuelName }}</p>
            <p class="text-sm text-gray-500">{{ number_format($tank->CurrentCapacity, 2) }} / {{ number_format($tank->MaxCapacity, 2) }} L</p>
            <div class="mt-2 bg-gray-200 rounded-full h-2">
                <div class="bg-red-500 h-2 rounded-full" style="width: {{ $pct }}%"></div>
            </div>
            <p class="text-xs text-gray-400 mt-1">{{ number_format($pct, 1) }}% capacity</p>
        </div>
        @endforeach
    </div>
</div>

{{-- Delivery History Table --}}
<div class="mt-8 bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-700">Recent Deliveries</h2>
        <a href="{{ route('deliveries.create') }}"
           class="bg-red-600 text-white text-sm px-3 py-1 rounded-lg hover:bg-red-700">
            + Add Delivery
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Supplier</th>
                    <th class="px-4 py-3">Contact Person</th>
                    <th class="px-4 py-3">Driver</th>
                    <th class="px-4 py-3">Plate</th>
                    <th class="px-4 py-3">Received By</th>
                    <th class="px-4 py-3 text-right">Total Cost</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recentDeliveries as $delivery)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $delivery->DeliveryDate }}</td>
                    <td class="px-4 py-3">{{ $delivery->supplier->SupplierCompany ?? 'N/A' }}</td>
                    <td class="px-4 py-3">{{ $delivery->SupplierName ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $delivery->Driver }}</td>
                    <td class="px-4 py-3">{{ $delivery->PlateNumber }}</td>
                    <td class="px-4 py-3">
                        {{ $delivery->employee->FirstName ?? '' }}
                        {{ $delivery->employee->LastName ?? 'N/A' }}
                    </td>
                    <td class="px-4 py-3 text-right font-medium">
                        ₱{{ number_format($delivery->TotalCost, 2) }}
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('deliveries.show', $delivery->DeliveryID) }}"
                           class="text-blue-600 hover:underline text-xs">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-8 text-center text-gray-400">
                        No deliveries recorded yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($recentDeliveries->count() >= 10)
    <div class="mt-3 text-right">
        <a href="{{ route('deliveries.index') }}"
           class="text-red-600 text-sm hover:underline">View all deliveries →</a>
    </div>
    @endif
</div>

@endsection