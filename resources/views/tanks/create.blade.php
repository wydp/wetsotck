@extends('layouts.app')
@section('title', 'Add Tank')
@section('breadcrumb', 'Inventory')
@section('page-title', 'Tanks')

@section('content')

<div>
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Add New Tank</h2>
        <p class="text-sm text-gray-400 mt-0.5">Register a new fuel tank to the inventory system.</p>
    </div>

    <form action="{{ route('tanks.store') }}" method="POST">
        @csrf

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-4">
            <div class="px-6 py-3 border-b border-gray-100 bg-gray-50">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Tank Details</h3>
            </div>
            <div class="p-6 space-y-5">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Fuel Type <span class="text-red-500">*</span></label>
                        <select name="FuelID" required
                            class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                   focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all bg-white">
                            <option value="">Select fuel type...</option>
                            @foreach($fuels as $fuel)
                            <option value="{{ $fuel->FuelID }}" {{ old('FuelID') == $fuel->FuelID ? 'selected' : '' }}>
                                {{ $fuel->FuelName }}
                            </option>
                            @endforeach
                        </select>
                        @error('FuelID')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Max Capacity (Liters) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="number" name="MaxCapacity" value="{{ old('MaxCapacity') }}"
                                min="1" step="0.01" required placeholder="e.g. 10000"
                                class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                       placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none">
                                <span class="text-xs text-gray-300 font-medium">L</span>
                            </div>
                        </div>
                        @error('MaxCapacity')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

            </div>
        </div>

        {{-- Info note --}}
        <div class="bg-blue-50 border border-blue-100 rounded-xl px-5 py-3.5 mb-6 flex items-start gap-3">
            <svg class="w-4 h-4 text-blue-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-blue-600">Current capacity starts at <strong>0.00 L</strong> and increases automatically when deliveries are recorded.</p>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-2.5 rounded-lg hover:bg-red-700 font-medium text-sm transition-colors shadow-sm">
                Save Tank
            </button>
            <a href="{{ route('tanks.index') }}"
                class="bg-white border border-gray-200 text-gray-600 px-6 py-2.5 rounded-lg hover:bg-gray-50 font-medium text-sm transition-colors">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection