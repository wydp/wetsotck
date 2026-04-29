<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wetstock — @yield('title', 'Gas Station Inventory')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-red-700 text-white px-6 py-4 flex items-center justify-between shadow">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold tracking-wide">
            ⛽ Wetstock
        </a>
        <div class="flex gap-6 text-sm font-medium">
            <a href="{{ route('deliveries.index') }}"  class="hover:text-red-200">Deliveries</a>
            <a href="{{ route('suppliers.index') }}"   class="hover:text-red-200">Suppliers</a>
            <a href="{{ route('employees.index') }}"   class="hover:text-red-200">Employees</a>
            <a href="{{ route('tanks.index') }}"       class="hover:text-red-200">Tanks</a>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-6">
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-6 py-8">
        @yield('content')
    </main>

</body>
</html>