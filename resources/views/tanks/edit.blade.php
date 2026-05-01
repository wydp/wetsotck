@extends('layouts.app')
@section('title', 'Edit Tank')
@section('content')

<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Tank</h1>

    <form action="{{ route('tanks.update', $tank->TankID) }}" method="POST"
          class="bg-white rounded-xl shadow p-6 space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Fuel Type</label>
            <select name="FuelID" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
                @foreach($fuels as $fuel)
                <option value="{{ $fuel->FuelID }}" {{ $tank->FuelID == $fuel->FuelID ? 'selected' : '' }}>
                    {{ $fuel->FuelName }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Max Capacity (Liters)</label>
            <input type="number" name="MaxCapacity" min="1" step="0.01" required
                value="{{ old('MaxCapacity', $tank->MaxCapacity) }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
        </div>

        <div class="bg-gray-50 rounded-lg p-3 text-sm text-gray-600">
            <p>Current Capacity: <strong>{{ number_format($tank->CurrentCapacity, 2) }} L</strong></p>
            <p class="text-xs text-gray-400 mt-1">Current capacity is managed automatically by the system.</p>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 font-medium text-sm">
                Update Tank
            </button>
            <a href="{{ route('tanks.index') }}"
                class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 font-medium text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection