@extends('layouts.app')
@section('title', 'Edit Tank')
@section('breadcrumb', 'Inventory')
@section('page-title', 'Tanks')

@section('content')

<div>
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Edit Tank</h2>
        <p class="text-sm text-gray-400 mt-0.5">Update the configuration for this fuel tank.</p>
    </div>

    <form action="{{ route('tanks.update', $tank->TankID) }}" method="POST">
        @csrf @method('PUT')

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
                            @foreach($fuels as $fuel)
                            <option value="{{ $fuel->FuelID }}" {{ $tank->FuelID == $fuel->FuelID ? 'selected' : '' }}>
                                {{ $fuel->FuelName }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Max Capacity (Liters) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="number" name="MaxCapacity" min="1" step="0.01" required
                                value="{{ old('MaxCapacity', $tank->MaxCapacity) }}"
                                class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm text-gray-800
                                       focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none">
                                <span class="text-xs text-gray-300 font-medium">L</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Current capacity read-only info --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-6">
            <div class="px-6 py-3 border-b border-gray-100 bg-gray-50">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Current Status</h3>
            </div>
            <div class="px-6 py-4 flex items-center gap-6">
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Current Capacity</p>
                    <p class="text-lg font-bold text-gray-800">{{ number_format($tank->CurrentCapacity, 2) }} <span class="text-sm font-normal text-gray-400">L</span></p>
                </div>
                <div class="h-8 w-px bg-gray-100"></div>
                <p class="text-xs text-gray-400">Current capacity is managed automatically by the system and cannot be edited directly.</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-2.5 rounded-lg hover:bg-red-700 font-medium text-sm transition-colors shadow-sm">
                Update Tank
            </button>
            <a href="{{ route('tanks.index') }}"
                class="bg-white border border-gray-200 text-gray-600 px-6 py-2.5 rounded-lg hover:bg-gray-50 font-medium text-sm transition-colors">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection