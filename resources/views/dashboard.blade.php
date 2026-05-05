@extends('layouts.app')
@section('title', 'Dashboard')
@section('breadcrumb', 'Seal Fuel System')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

    <a href="{{ route('deliveries.index') }}"
       class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md hover:border-red-200 transition-all group">
        <div class="flex flex-col h-24">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Deliveries</p>
            <div class="flex-1"></div>
            <div class="flex items-end justify-between">
                <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center group-hover:bg-red-100 transition-colors">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <p class="text-4xl font-bold text-gray-800">{{ \App\Models\Delivery::count() }}</p>
            </div>
        </div>
    </a>

    <a href="{{ route('suppliers.index') }}"
       class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md hover:border-red-200 transition-all group">
        <div class="flex flex-col h-24">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Suppliers</p>
            <div class="flex-1"></div>
            <div class="flex items-end justify-between">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                    <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                    </svg>
                </div>
                <p class="text-4xl font-bold text-gray-800">{{ \App\Models\Supplier::whereNull('deleted_at')->count() }}</p>
            </div>
        </div>
    </a>

    <a href="{{ route('tanks.index') }}"
       class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md hover:border-red-200 transition-all group">
        <div class="flex flex-col h-24">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanks</p>
            <div class="flex-1"></div>
            <div class="flex items-end justify-between">
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center group-hover:bg-green-100 transition-colors">
                    <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <p class="text-4xl font-bold text-gray-800">{{ \App\Models\Tank::count() }}</p>
            </div>
        </div>
    </a>

</div>

{{-- Tank Levels --}}
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Current Tank Levels</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach(\App\Models\Tank::with('fuel')->get() as $tank)
        @php
            $pct = $tank->MaxCapacity > 0
                ? ($tank->CurrentCapacity / $tank->MaxCapacity) * 100
                : 0;
            $color = $pct > 60 ? 'bg-green-500' : ($pct > 25 ? 'bg-yellow-500' : 'bg-red-500');
            $badge = $pct > 60 ? 'text-green-700 bg-green-50' : ($pct > 25 ? 'text-yellow-700 bg-yellow-50' : 'text-red-700 bg-red-50');
        @endphp
        <div class="border border-gray-100 rounded-xl p-4 hover:border-gray-200 transition-colors">
            <div class="flex items-center justify-between mb-3">
                <p class="font-semibold text-gray-800">{{ $tank->fuel->FuelName }}</p>
                <span class="text-xs font-medium px-2 py-0.5 rounded-full {{ $badge }}">
                    {{ number_format($pct, 1) }}%
                </span>
            </div>
            <div class="bg-gray-100 rounded-full h-2 mb-2">
                <div class="{{ $color }} h-2 rounded-full transition-all" style="width: {{ min($pct, 100) }}%"></div>
            </div>
            <div class="flex justify-between text-xs text-gray-400">
                <span>{{ number_format($tank->CurrentCapacity, 2) }} L</span>
                <span>{{ number_format($tank->MaxCapacity, 2) }} L max</span>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Recent Deliveries --}}
<div class="bg-white rounded-xl border border-gray-200">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Recent Deliveries</h2>
        <a href="{{ route('deliveries.create') }}"
           class="bg-red-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-red-700 transition-colors font-medium flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Delivery
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-100">
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Supplier</th>
                    <th class="px-6 py-3 text-left">Contact Person</th>
                    <th class="px-6 py-3 text-left">Driver</th>
                    <th class="px-6 py-3 text-left">Plate</th>
                    <th class="px-6 py-3 text-left">Received By</th>
                    <th class="px-6 py-3 text-right">Total Cost</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($recentDeliveries as $delivery)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($delivery->DeliveryDate)->format('M d, Y') }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $delivery->supplier->SupplierCompany ?? '—' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $delivery->SupplierName ?? '—' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $delivery->Driver }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs font-mono">{{ $delivery->PlateNumber }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $delivery->employee->FirstName ?? '' }} {{ $delivery->employee->LastName ?? '—' }}
                    </td>
                    <td class="px-6 py-4 text-right font-semibold text-gray-800">
                        ₱{{ number_format($delivery->TotalCost, 2) }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('deliveries.show', $delivery->DeliveryID) }}"
                           class="inline-flex items-center gap-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium px-3 py-1.5 rounded-lg transition-colors"
                           title="View delivery details">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                        <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                        </svg>
                        No deliveries recorded yet
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($recentDeliveries->count() >= 10)
    <div class="px-6 py-3 border-t border-gray-100 text-right">
        <a href="{{ route('deliveries.index') }}" class="text-red-600 text-sm hover:underline font-medium">View all deliveries →</a>
    </div>
    @endif
</div>

@endsection