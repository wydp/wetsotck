@extends('layouts.app')
@section('title', 'Tanks')
@section('breadcrumb', 'Stock-In')
@section('page-title', 'Tanks')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-400">{{ $tanks->count() }} {{ Str::plural('tank', $tanks->count()) }}</p>
    <a href="{{ route('tanks.create') }}"
       class="bg-red-600 text-white px-4 py-2.5 rounded-lg hover:bg-red-700 text-sm font-medium
              flex items-center gap-2 shadow-sm transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Tank
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    @foreach($tanks as $tank)
    @php
        $pct     = $tank->MaxCapacity > 0 ? ($tank->CurrentCapacity / $tank->MaxCapacity) * 100 : 0;
        $pctRnd  = round($pct, 1);

        // Fill color based on level
        if ($pct > 60) {
            $fillColor  = '#1D9E75';   // teal — healthy
            $fillAlpha  = '0.25';
            $statusClass = 'bg-green-50 text-green-700';
            $statusText  = 'Good level';
        } elseif ($pct > 25) {
            $fillColor  = '#EF9F27';   // amber — warning
            $fillAlpha  = '0.30';
            $statusClass = 'bg-yellow-50 text-yellow-700';
            $statusText  = 'Half full';
        } else {
            $fillColor  = '#E24B4A';   // red — low
            $fillAlpha  = '0.30';
            $statusClass = 'bg-red-50 text-red-700';
            $statusText  = 'Low stock';
        }
    @endphp

    <div class="bg-white rounded-xl border border-gray-200 p-5 flex flex-col gap-4
                hover:border-gray-300 hover:shadow-sm transition-all">

        {{-- Top: Name + Actions --}}
        <div class="flex items-start justify-between">
            <div>
                <p class="font-semibold text-gray-800 text-sm">{{ $tank->fuel->FuelName }} Tank</p>
                <p class="text-xs text-gray-400 mt-0.5">Tank #{{ $tank->TankID }}</p>
            </div>
            <div class="flex gap-1.5">
                {{-- Edit --}}
                <div class="relative group">
                    <a href="{{ route('tanks.edit', $tank->TankID) }}"
                       class="w-7 h-7 flex items-center justify-center rounded-lg border border-gray-200
                              text-gray-400 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1.5 px-2 py-1 bg-gray-800
                                text-white text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100
                                transition-opacity pointer-events-none z-10">
                        Edit tank
                        <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                    </div>
                </div>
                {{-- Delete --}}
                <div class="relative group">
                    <form action="{{ route('tanks.destroy', $tank->TankID) }}" method="POST"
                          onsubmit="return confirm('Delete this tank? This cannot be undone.')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="w-7 h-7 flex items-center justify-center rounded-lg border border-gray-200
                                   text-gray-400 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                    <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1.5 px-2 py-1 bg-gray-800
                                text-white text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100
                                transition-opacity pointer-events-none z-10">
                        Delete tank
                        <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Vertical Fill Graph --}}
        <div class="relative rounded-xl overflow-hidden bg-gray-100" style="height: 140px;">
            {{-- Fill rises from the bottom --}}
            <div class="absolute bottom-0 left-0 right-0 rounded-xl transition-all duration-500"
                 style="height: {{ $pctRnd }}%;
                        background-color: {{ $fillColor }};
                        opacity: {{ $fillAlpha }}">
            </div>
            {{-- Centered text overlay --}}
            <div class="absolute inset-0 flex flex-col items-center justify-center gap-0.5">
                <span class="text-3xl font-bold text-gray-800">{{ $pctRnd }}%</span>
                <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">capacity</span>
            </div>
        </div>

        {{-- Bottom: Volume + Status --}}
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    <span class="font-semibold">{{ number_format($tank->CurrentCapacity, 2) }}</span>
                    <span class="text-gray-400"> / {{ number_format($tank->MaxCapacity, 2) }} L</span>
                </p>
            </div>
            <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $statusClass }}">
                {{ $statusText }}
            </span>
        </div>

    </div>
    @endforeach
</div>

@endsection