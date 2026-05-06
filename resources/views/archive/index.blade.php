@extends('layouts.app')
@section('title', 'Archive')
@section('breadcrumb', 'System')
@section('page-title', 'Archive')

@section('content')

<p class="text-sm text-gray-400 mb-6">
    Archived records are hidden from normal views but preserved in the database.
    You can restore them or permanently delete them here.
</p>

{{-- Tab Navigation --}}
<div class="flex gap-1 mb-6 bg-gray-100 p-1 rounded-xl w-fit">
    @foreach(['suppliers' => 'Suppliers', 'tanks' => 'Tanks', 'employees' => 'Employees', 'deliveries' => 'Deliveries'] as $key => $label)
    @php
        $counts = [
            'suppliers'  => $archivedSuppliers->count(),
            'tanks'      => $archivedTanks->count(),
            'employees'  => $archivedEmployees->count(),
            'deliveries' => $archivedDeliveries->count(),
        ];
    @endphp
    <button onclick="showTab('{{ $key }}')" id="tab-{{ $key }}"
        class="tab-btn px-4 py-2 rounded-lg text-sm font-medium transition-all flex items-center gap-2">
        {{ $label }}
        @if($counts[$key] > 0)
        <span class="tab-badge-{{ $key }} bg-red-100 text-red-600 text-xs font-semibold px-1.5 py-0.5 rounded-full">
            {{ $counts[$key] }}
        </span>
        @endif
    </button>
    @endforeach
</div>

{{-- Suppliers Archive --}}
<div id="panel-suppliers" class="archive-panel">
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Archived Suppliers
                <span class="text-gray-400 font-normal">({{ $archivedSuppliers->count() }})</span>
            </h2>
        </div>
        @if($archivedSuppliers->isEmpty())
            @include('archive._empty', ['label' => 'archived suppliers'])
        @else
        <div class="divide-y divide-gray-100">
            @foreach($archivedSuppliers as $supplier)
            <div class="px-6 py-4 flex items-center gap-4 hover:bg-gray-50 transition-colors">
                <div class="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-gray-400 font-semibold text-sm">
                        {{ strtoupper(substr($supplier->SupplierCompany ?? $supplier->SupplierName, 0, 1)) }}
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-gray-700 text-sm">{{ $supplier->SupplierCompany ?? '—' }}</p>
                    <p class="text-xs text-gray-400">{{ $supplier->SupplierName }} · {{ $supplier->ContactNumber ?? 'No number' }}</p>
                </div>
                <p class="text-xs text-gray-400 flex-shrink-0">
                    Archived {{ $supplier->deleted_at->diffForHumans() }}
                </p>
                @include('archive._actions', ['type' => 'supplier', 'id' => $supplier->SupplierID])
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- Tanks Archive --}}
<div id="panel-tanks" class="archive-panel hidden">
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Archived Tanks
                <span class="text-gray-400 font-normal">({{ $archivedTanks->count() }})</span>
            </h2>
        </div>
        @if($archivedTanks->isEmpty())
            @include('archive._empty', ['label' => 'archived tanks'])
        @else
        <div class="divide-y divide-gray-100">
            @foreach($archivedTanks as $tank)
            <div class="px-6 py-4 flex items-center gap-4 hover:bg-gray-50 transition-colors">
                <div class="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-gray-700 text-sm">{{ $tank->fuel->FuelName ?? 'Unknown' }} Tank</p>
                    <p class="text-xs text-gray-400">
                        Tank #{{ $tank->TankID }} ·
                        {{ number_format($tank->CurrentCapacity, 2) }} / {{ number_format($tank->MaxCapacity, 2) }} L
                    </p>
                </div>
                <p class="text-xs text-gray-400 flex-shrink-0">
                    Archived {{ $tank->deleted_at->diffForHumans() }}
                </p>
                @include('archive._actions', ['type' => 'tank', 'id' => $tank->TankID])
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- Employees Archive --}}
<div id="panel-employees" class="archive-panel hidden">
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Archived Employees
                <span class="text-gray-400 font-normal">({{ $archivedEmployees->count() }})</span>
            </h2>
        </div>
        @if($archivedEmployees->isEmpty())
            @include('archive._empty', ['label' => 'archived employees'])
        @else
        <div class="divide-y divide-gray-100">
            @foreach($archivedEmployees as $employee)
            <div class="px-6 py-4 flex items-center gap-4 hover:bg-gray-50 transition-colors">
                <div class="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-gray-400 font-semibold text-sm">
                        {{ strtoupper(substr($employee->FirstName, 0, 1)) }}{{ strtoupper(substr($employee->LastName, 0, 1)) }}
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-gray-700 text-sm">
                        {{ $employee->FirstName }}
                        {{ $employee->MiddleName ? $employee->MiddleName . ' ' : '' }}
                        {{ $employee->LastName }}
                    </p>
                    <p class="text-xs text-gray-400">{{ $employee->Role }} · {{ $employee->ContactNumber ?? 'No number' }}</p>
                </div>
                <p class="text-xs text-gray-400 flex-shrink-0">
                    Archived {{ $employee->deleted_at->diffForHumans() }}
                </p>
                @include('archive._actions', ['type' => 'employee', 'id' => $employee->EmployeeID])
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- Deliveries Archive --}}
<div id="panel-deliveries" class="archive-panel hidden">
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
                Archived Deliveries
                <span class="text-gray-400 font-normal">({{ $archivedDeliveries->count() }})</span>
            </h2>
        </div>
        @if($archivedDeliveries->isEmpty())
            @include('archive._empty', ['label' => 'archived deliveries'])
        @else
        <div class="divide-y divide-gray-100">
            @foreach($archivedDeliveries as $delivery)
            <div class="px-6 py-4 flex items-center gap-4 hover:bg-gray-50 transition-colors">
                <div class="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-gray-700 text-sm">
                        {{ $delivery->supplier->SupplierCompany ?? '—' }}
                        <span class="text-gray-400 font-normal">· {{ \Carbon\Carbon::parse($delivery->DeliveryDate)->format('M d, Y') }}</span>
                    </p>
                    <p class="text-xs text-gray-400">
                        Driver: {{ $delivery->Driver }} · Plate: {{ $delivery->PlateNumber }} ·
                        <span class="font-medium">₱{{ number_format($delivery->TotalCost, 2) }}</span>
                    </p>
                </div>
                <p class="text-xs text-gray-400 flex-shrink-0">
                    Archived {{ $delivery->deleted_at->diffForHumans() }}
                </p>
                @include('archive._actions', ['type' => 'delivery', 'id' => $delivery->DeliveryID])
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- Tab switcher script --}}
<script>
function showTab(name) {
    document.querySelectorAll('.archive-panel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(b => {
        b.classList.remove('bg-white', 'text-gray-800', 'shadow-sm');
        b.classList.add('text-gray-500');
    });
    document.getElementById('panel-' + name).classList.remove('hidden');
    const btn = document.getElementById('tab-' + name);
    btn.classList.add('bg-white', 'text-gray-800', 'shadow-sm');
    btn.classList.remove('text-gray-500');
}
// Show first tab on load
showTab('suppliers');
</script>

@endsection