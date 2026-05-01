@extends('layouts.app')
@section('title', 'Add Tank')
@section('content')

<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add Tank</h1>

    <form action="{{ route('tanks.store') }}" method="POST"
          class="bg-white rounded-xl shadow p-6 space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Fuel Type <span class="text-red-500">*</span></label>
            <select name="FuelID" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
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
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Max Capacity (Liters) <span class="text-red-500">*</span>
            </label>
            <input type="number" name="MaxCapacity" value="{{ old('MaxCapacity') }}"
                min="1" step="0.01" required placeholder="e.g. 10000"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
            @error('MaxCapacity')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <p class="text-xs text-gray-400">
            Current capacity starts at 0.00 L and increases automatically when deliveries are recorded.
        </p>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 font-medium text-sm">
                Save Tank
            </button>
            <a href="{{ route('tanks.index') }}"
                class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 font-medium text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection