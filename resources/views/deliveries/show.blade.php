@extends('layouts.app')
@section('title', 'Delivery Details')
@section('breadcrumb', 'Deliveries')
@section('page-title', 'Delivery #{{ $delivery->DeliveryID }}')

@section('content')

<div class="flex items-center justify-between mb-6">
    <a href="{{ route('deliveries.index') }}"
       class="flex items-center gap-2 text-gray-500 hover:text-gray-700 text-sm transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Deliveries
    </a>

    {{-- Delete button is here in the details view --}}
    <form action="{{ route('deliveries.destroy', $delivery->DeliveryID) }}" method="POST"
          onsubmit="return confirm('Delete this delivery? This will also remove all fuel line items and cannot be undone.')">
        @csrf @method('DELETE')
        <button type="submit"
            class="flex items-center gap-2 bg-red-50 text-red-600 border border-red-200
                   hover:bg-red-600 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            Delete Delivery
        </button>
    </form>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Delivery Info --}}
    <div class="lg:col-span-1 bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Delivery Information</h2>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Date</p>
                <p class="text-sm font-semibold text-gray-800">
                    {{ \Carbon\Carbon::parse($delivery->DeliveryDate)->format('F d, Y') }}
                </p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Supplier Company</p>
                <p class="text-sm font-semibold text-gray-800">{{ $delivery->supplier->SupplierCompany ?? '—' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Contact Person</p>
                <p class="text-sm text-gray-700">{{ $delivery->SupplierName ?? '—' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Driver</p>
                <p class="text-sm text-gray-700">{{ $delivery->Driver }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Plate Number</p>
                <p class="text-sm font-mono bg-gray-100 inline-block px-2 py-0.5 rounded text-gray-700">
                    {{ $delivery->PlateNumber }}
                </p>
            </div>
            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Received By</p>
                <p class="text-sm text-gray-700">
                    {{ $delivery->employee->FirstName ?? '' }} {{ $delivery->employee->LastName ?? '—' }}
                </p>
                @if($delivery->employee)
                <p class="text-xs text-gray-400">{{ $delivery->employee->Role }}</p>
                @endif
            </div>
            <div class="pt-4 border-t border-gray-100">
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Total Cost</p>
                <p class="text-2xl font-bold text-gray-800">₱{{ number_format($delivery->TotalCost, 2) }}</p>
            </div>
        </div>
    </div>

    {{-- Fuel Line Items --}}
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Fuel Line Items</h2>
            <p class="text-xs text-gray-400 mt-0.5">{{ $delivery->deliveryDetails->count() }} {{ Str::plural('item', $delivery->deliveryDetails->count()) }}</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-100">
                        <th class="px-6 py-3 text-left">Tank / Fuel</th>
                        <th class="px-6 py-3 text-right">Quantity</th>
                        <th class="px-6 py-3 text-right">Unit Cost</th>
                        <th class="px-6 py-3 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($delivery->deliveryDetails as $detail)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-800">{{ $detail->tank->fuel->FuelName ?? 'N/A' }}</p>
                            <p class="text-xs text-gray-400">Tank #{{ $detail->TankID }}</p>
                        </td>
                        <td class="px-6 py-4 text-right text-gray-700">
                            {{ number_format($detail->Quantity, 2) }} L
                        </td>
                        <td class="px-6 py-4 text-right text-gray-700">
                            ₱{{ number_format($detail->UnitCost, 2) }}
                        </td>
                        <td class="px-6 py-4 text-right font-semibold text-gray-800">
                            ₱{{ number_format($detail->Subtotal, 2) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50 border-t-2 border-gray-200">
                        <td colspan="3" class="px-6 py-4 text-right font-semibold text-gray-700 text-sm">Total</td>
                        <td class="px-6 py-4 text-right font-bold text-gray-900 text-base">
                            ₱{{ number_format($delivery->TotalCost, 2) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

@endsection