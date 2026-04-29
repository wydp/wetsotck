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

@endsection