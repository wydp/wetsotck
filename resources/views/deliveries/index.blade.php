@extends('layouts.app')
@section('title', 'Deliveries')
@section('breadcrumb', 'Stock-In')
@section('page-title', 'Deliveries')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-400">{{ $deliveries->count() }} {{ Str::plural('record', $deliveries->count()) }} found</p>
    <a href="{{ route('deliveries.create') }}"
       class="bg-red-600 text-white text-sm px-4 py-2.5 rounded-lg hover:bg-red-700 transition-colors font-medium flex items-center gap-2 shadow-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Delivery
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-200">
                <th class="px-6 py-3 text-left">ID</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3 text-left">Supplier</th>
                <th class="px-6 py-3 text-left">Driver</th>
                <th class="px-6 py-3 text-left">Plate</th>
                <th class="px-6 py-3 text-right">Total Cost</th>
                <th class="px-6 py-3 text-left">Received By</th>
                <th class="px-6 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($deliveries as $delivery)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-gray-400 text-xs">#{{ $delivery->DeliveryID }}</td>
                <td class="px-6 py-4 text-gray-700">
                    {{ \Carbon\Carbon::parse($delivery->DeliveryDate)->format('M d, Y') }}
                </td>
                <td class="px-6 py-4">
                    <p class="font-medium text-gray-800">{{ $delivery->supplier->SupplierCompany ?? '—' }}</p>
                    @if($delivery->SupplierName)
                    <p class="text-xs text-gray-400">{{ $delivery->SupplierName }}</p>
                    @endif
                </td>
                <td class="px-6 py-4 text-gray-600">{{ $delivery->Driver }}</td>
                <td class="px-6 py-4">
                    <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs font-mono">
                        {{ $delivery->PlateNumber }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right font-semibold text-gray-800">
                    ₱{{ number_format($delivery->TotalCost, 2) }}
                </td>
                <td class="px-6 py-4 text-gray-600">
                    {{ $delivery->employee->FirstName ?? '' }} {{ $delivery->employee->LastName ?? '—' }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-center">
                        {{-- View Button with tooltip --}}
                        <div class="relative group">
                            <a href="{{ route('deliveries.show', $delivery->DeliveryID) }}"
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100
                                      hover:bg-blue-100 hover:text-blue-600 text-gray-500 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            {{-- Tooltip --}}
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white text-xs
                                        rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-10">
                                View delivery details
                                <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-16 text-center">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                    </svg>
                    <p class="text-gray-400 text-sm">No deliveries recorded yet</p>
                    <a href="{{ route('deliveries.create') }}" class="text-red-600 text-sm hover:underline mt-1 inline-block">
                        Record first delivery →
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection