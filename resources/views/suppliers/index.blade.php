@extends('layouts.app')
@section('title', 'Suppliers')
@section('breadcrumb', 'Stock-In')
@section('page-title', 'Suppliers')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-400">{{ $suppliers->count() }} {{ Str::plural('supplier', $suppliers->count()) }}</p>
    <a href="{{ route('suppliers.create') }}"
       class="bg-red-600 text-white text-sm px-4 py-2.5 rounded-lg hover:bg-red-700
              transition-colors font-medium flex items-center gap-2 shadow-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Supplier
    </a>
</div>

{{-- Supplier Cards --}}
<div class="space-y-3">
    @forelse($suppliers as $supplier)
    <div class="bg-white rounded-xl border border-gray-200 px-6 py-4
                hover:border-gray-300 hover:shadow-sm transition-all flex items-center gap-6">

        {{-- Avatar --}}
        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
            <span class="text-red-600 font-bold text-sm">
                {{ strtoupper(substr($supplier->SupplierCompany ?? $supplier->SupplierName, 0, 1)) }}
            </span>
        </div>

        {{-- Company --}}
        <div class="w-48 flex-shrink-0">
            <p class="font-semibold text-gray-800 text-sm">{{ $supplier->SupplierCompany ?? '—' }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Company</p>
        </div>

        {{-- Contact Person --}}
        <div class="w-40 flex-shrink-0">
            <p class="text-sm text-gray-700">{{ $supplier->SupplierName }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Contact Person</p>
        </div>

        {{-- Phone --}}
        <div class="w-36 flex-shrink-0">
            <p class="text-sm text-gray-700 font-mono">{{ $supplier->ContactNumber ?? '—' }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Contact Number</p>
        </div>

        {{-- Address --}}
        <div class="flex-1 min-w-0">
            <p class="text-sm text-gray-700 truncate">{{ $supplier->Address ?? '—' }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Address</p>
        </div>

        {{-- Status badge --}}
        <div class="flex-shrink-0">
            @if(is_null($supplier->deleted_at))
                <span class="bg-green-50 text-green-700 text-xs font-medium px-2.5 py-1 rounded-full">Active</span>
            @else
                <span class="bg-gray-100 text-gray-500 text-xs font-medium px-2.5 py-1 rounded-full">Archived</span>
            @endif
        </div>

        {{-- Edit button only --}}
        <div class="flex-shrink-0">
            <div class="relative group">
                <a href="{{ route('suppliers.edit', $supplier->SupplierID) }}"
                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100
                          hover:bg-blue-100 hover:text-blue-600 text-gray-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </a>
                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white
                            text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-10">
                    Edit supplier
                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                </div>
            </div>
        </div>

    </div>
    @empty
    <div class="bg-white rounded-xl border border-gray-200 px-6 py-16 text-center">
        <svg class="w-10 h-10 mx-auto mb-3 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/>
        </svg>
        <p class="text-gray-400 text-sm">No suppliers found</p>
        <a href="{{ route('suppliers.create') }}" class="text-red-600 text-sm hover:underline mt-1 inline-block">
            Add first supplier →
        </a>
    </div>
    @endforelse
</div>

@endsection