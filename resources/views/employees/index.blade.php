@extends('layouts.app')
@section('title', 'Employees')
@section('breadcrumb', 'Staff')
@section('page-title', 'Employees')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-400">{{ $employees->count() }} {{ Str::plural('employee', $employees->count()) }}</p>
    <a href="{{ route('employees.create') }}"
       class="bg-red-600 text-white text-sm px-4 py-2.5 rounded-lg hover:bg-red-700
              transition-colors font-medium flex items-center gap-2 shadow-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Employee
    </a>
</div>

{{-- Employee Cards --}}
<div class="space-y-3">
    @forelse($employees as $employee)
    <div class="bg-white rounded-xl border border-gray-200 px-6 py-4
                hover:border-gray-300 hover:shadow-sm transition-all flex items-center gap-6">

        {{-- Avatar --}}
        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
            <span class="text-red-600 font-bold text-sm">
                {{ strtoupper(substr($employee->FirstName, 0, 1)) }}{{ strtoupper(substr($employee->LastName, 0, 1)) }}
            </span>
        </div>

        {{-- Full Name --}}
        <div class="w-52 flex-shrink-0">
            <p class="font-semibold text-gray-800 text-sm">
                {{ $employee->FirstName }}
                {{ $employee->MiddleName ? $employee->MiddleName . ' ' : '' }}
                {{ $employee->LastName }}
            </p>
            <p class="text-xs text-gray-400 mt-0.5">Full Name</p>
        </div>

        {{-- Contact --}}
        <div class="w-36 flex-shrink-0">
            <p class="text-sm text-gray-700 font-mono">{{ $employee->ContactNumber ?? '—' }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Contact Number</p>
        </div>

        {{-- Role --}}
        <div class="w-36 flex-shrink-0">
            <p class="text-sm text-gray-700">{{ $employee->Role }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Role</p>
        </div>

        {{-- Address --}}
        <div class="flex-1 min-w-0">
            <p class="text-sm text-gray-700 truncate">{{ $employee->Address ?? '—' }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Address</p>
        </div>

        {{-- Status badge --}}
        <div class="flex-shrink-0">
            @if($employee->IsActive)
                <span class="bg-green-50 text-green-700 text-xs font-medium px-2.5 py-1 rounded-full">Active</span>
            @else
                <span class="bg-gray-100 text-gray-500 text-xs font-medium px-2.5 py-1 rounded-full">Inactive</span>
            @endif
        </div>

        {{-- Actions --}}
        <div class="flex-shrink-0 flex items-center gap-2">

            {{-- Edit --}}
            <div class="relative group">
                <a href="{{ route('employees.edit', $employee->EmployeeID) }}"
                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100
                          hover:bg-blue-100 hover:text-blue-600 text-gray-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </a>
                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white
                            text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-10">
                    Edit employee
                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                </div>
            </div>

            {{-- Deactivate --}}
            <div class="relative group">
                <form action="{{ route('employees.destroy', $employee->EmployeeID) }}"
                      method="POST"
                      onsubmit="return confirm('Deactivate this employee?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100
                                   hover:bg-red-100 hover:text-red-600 text-gray-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </button>
                </form>
                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white
                            text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-10">
                    Deactivate
                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                </div>
            </div>

        </div>
    </div>
    @empty
    <div class="bg-white rounded-xl border border-gray-200 px-6 py-16 text-center">
        <svg class="w-10 h-10 mx-auto mb-3 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        <p class="text-gray-400 text-sm">No employees found</p>
        <a href="{{ route('employees.create') }}" class="text-red-600 text-sm hover:underline mt-1 inline-block">
            Add first employee →
        </a>
    </div>
    @endforelse
</div>

@endsection