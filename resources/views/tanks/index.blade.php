@extends('layouts.app')
@section('title', 'Tanks')
@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tanks</h1>
    <a href="{{ route('tanks.create') }}"
       class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm font-medium">
        + Add Tank
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    @foreach($tanks as $tank)
    @php $pct = $tank->MaxCapacity > 0 ? ($tank->CurrentCapacity / $tank->MaxCapacity) * 100 : 0; @endphp
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex justify-between items-start mb-3">
            <div>
                <p class="font-bold text-gray-800 text-lg">{{ $tank->fuel->FuelName }} Tank</p>
                <p class="text-xs text-gray-400">Tank #{{ $tank->TankID }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('tanks.edit', $tank->TankID) }}"
                   class="text-blue-600 hover:underline text-xs">Edit</a>
                <form action="{{ route('tanks.destroy', $tank->TankID) }}" method="POST"
                      onsubmit="return confirm('Delete this tank?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600 hover:underline text-xs">Delete</button>
                </form>
            </div>
        </div>

        <div class="mt-3 bg-gray-200 rounded-full h-3">
            <div class="h-3 rounded-full {{ $pct > 70 ? 'bg-green-500' : ($pct > 30 ? 'bg-yellow-500' : 'bg-red-500') }}"
                 style="width: {{ $pct }}%"></div>
        </div>

        <div class="mt-2 flex justify-between text-sm">
            <span class="text-gray-500">{{ number_format($tank->CurrentCapacity, 2) }} L</span>
            <span class="text-gray-400">/ {{ number_format($tank->MaxCapacity, 2) }} L</span>
        </div>
        <p class="text-xs text-gray-400 mt-1">{{ number_format($pct, 1) }}% full</p>
    </div>
    @endforeach
</div>

@endsection