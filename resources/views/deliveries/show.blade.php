@extends('layouts.app')
@section('title', 'Delivery Details')
@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Delivery #{{ $delivery->DeliveryID }}</h1>
    <a href="{{ route('deliveries.index') }}" class="text-gray-500 hover:underline text-sm">← Back</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4 border-b pb-2">Delivery Info</h2>
        <dl class="space-y-2 text-sm">
            <div class="flex justify-between"><dt class="text-gray-500">Date</dt><dd>{{ $delivery->DeliveryDate }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Supplier</dt><dd>{{ $delivery->supplier->SupplierCompany ?? 'N/A' }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Driver</dt><dd>{{ $delivery->Driver }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Plate</dt><dd>{{ $delivery->PlateNumber }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Received By</dt><dd>{{ $delivery->employee->FirstName ?? '' }} {{ $delivery->employee->LastName ?? 'N/A' }}</dd></div>
            <div class="flex justify-between font-semibold"><dt>Total Cost</dt><dd>₱{{ number_format($delivery->TotalCost, 2) }}</dd></div>
        </dl>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4 border-b pb-2">Fuel Line Items</h2>
        <table class="w-full text-sm">
            <thead class="text-gray-500 text-xs uppercase">
                <tr>
                    <th class="text-left pb-2">Tank</th>
                    <th class="text-right pb-2">Qty (L)</th>
                    <th class="text-right pb-2">Unit Cost</th>
                    <th class="text-right pb-2">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($delivery->deliveryDetails as $detail)
                <tr>
                    <td class="py-2">{{ $detail->tank->fuel->FuelName ?? 'N/A' }}</td>
                    <td class="py-2 text-right">{{ number_format($detail->Quantity, 2) }}</td>
                    <td class="py-2 text-right">₱{{ number_format($detail->UnitCost, 2) }}</td>
                    <td class="py-2 text-right">₱{{ number_format($detail->Subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection