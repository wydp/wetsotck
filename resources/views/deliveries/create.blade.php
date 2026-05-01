@extends('layouts.app')
@section('title', 'Add Delivery')
@section('content')

<h1 class="text-2xl font-bold text-gray-800 mb-6">Add Delivery</h1>

<form action="{{ route('deliveries.store') }}" method="POST" id="deliveryForm">
@csrf

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- LEFT: Delivery Header --}}
    <div class="bg-white rounded-xl shadow p-6 space-y-4">
        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Delivery Information</h2>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Supplier</label>
            <select name="SupplierID" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
                <option value="">Select supplier...</option>
                @foreach($suppliers as $supplier)
                <option value="{{ $supplier->SupplierID }}">{{ $supplier->SupplierCompany }} — {{ $supplier->SupplierName }}</option>
                @endforeach
            </select>
        </div>

        {{-- After the SupplierID dropdown --}}
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Contact Person
                <span class="text-gray-400 font-normal">(person who handled this delivery)</span>
            </label>
            <input type="text" name="SupplierName" required
                placeholder="e.g. Ramon Dela Cruz"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Driver</label>
            <input type="text" name="Driver" required placeholder="Driver's full name"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Plate Number</label>
            <input type="text" name="PlateNumber" required placeholder="e.g. ABC 1234"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Delivery Date</label>
            <input type="date" name="DeliveryDate" required value="{{ date('Y-m-d') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Received By</label>
            <select name="EmployeeID" required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
                <option value="">Select employee...</option>
                @foreach($employees as $employee)
                <option value="{{ $employee->EmployeeID }}">{{ $employee->FirstName }} {{ $employee->LastName }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- RIGHT: Delivery Details --}}
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Fuel Details</h2>
            <button type="button" onclick="addRow()"
                class="bg-red-600 text-white text-sm px-3 py-1 rounded-lg hover:bg-red-700">
                + Add Row
            </button>
        </div>

        <div id="detailRows" class="space-y-3">
            {{-- Rows added by JavaScript --}}
        </div>

        <div class="mt-4 text-right font-semibold text-gray-700">
            Total Cost: ₱<span id="totalCost">0.00</span>
        </div>
    </div>

</div>

<div class="mt-6 flex gap-3">
    <button type="submit"
        class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 font-medium">
        Save Delivery
    </button>
    <a href="{{ route('deliveries.index') }}"
        class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 font-medium">
        Cancel
    </a>
</div>

</form>

<script>
// Tank options from Laravel passed to JS
const tanks = @json($tanks->map(fn($t) => ['id' => $t->TankID, 'label' => $t->fuel->FuelName . ' Tank (Max: ' . number_format($t->MaxCapacity, 0) . 'L)']));

let rowIndex = 0;

function addRow() {
    const container = document.getElementById('detailRows');
    const div = document.createElement('div');
    div.className = 'grid grid-cols-4 gap-2 items-center';
    div.id = 'row_' + rowIndex;

    // Build tank options
    let options = '<option value="">Select tank...</option>';
    tanks.forEach(t => {
        options += `<option value="${t.id}">${t.label}</option>`;
    });

    div.innerHTML = `
        <select name="details[${rowIndex}][TankID]" required onchange="calcRow(${rowIndex})"
            class="border border-gray-300 rounded-lg px-2 py-2 text-sm col-span-2">
            ${options}
        </select>
        <input type="number" name="details[${rowIndex}][Quantity]" placeholder="Qty (L)" min="0.01" step="0.01" required
            onchange="calcRow(${rowIndex})"
            class="border border-gray-300 rounded-lg px-2 py-2 text-sm">
        <input type="number" name="details[${rowIndex}][UnitCost]" placeholder="₱/L" min="0.01" step="0.01" required
            onchange="calcRow(${rowIndex})"
            class="border border-gray-300 rounded-lg px-2 py-2 text-sm">
        <div class="col-span-3 text-right text-sm text-gray-600">
            Subtotal: ₱<span id="subtotal_${rowIndex}">0.00</span>
        </div>
        <button type="button" onclick="removeRow(${rowIndex})"
            class="text-red-500 hover:text-red-700 text-sm font-bold">✕</button>
    `;

    container.appendChild(div);
    rowIndex++;
}

function calcRow(index) {
    const qty  = parseFloat(document.querySelector(`[name="details[${index}][Quantity]"]`)?.value) || 0;
    const cost = parseFloat(document.querySelector(`[name="details[${index}][UnitCost]"]`)?.value) || 0;
    const sub  = qty * cost;
    document.getElementById('subtotal_' + index).textContent = sub.toFixed(2);
    calcTotal();
}

function calcTotal() {
    let total = 0;
    document.querySelectorAll('[id^="subtotal_"]').forEach(el => {
        total += parseFloat(el.textContent) || 0;
    });
    document.getElementById('totalCost').textContent = total.toFixed(2);
}

function removeRow(index) {
    document.getElementById('row_' + index)?.remove();
    calcTotal();
}

// Auto-fill supplier name when dropdown changes
const supplierNames = @json($suppliers->pluck('SupplierName', 'SupplierID'));

document.querySelector('[name="SupplierID"]').addEventListener('change', function() {
    const selected = this.value;
    const nameInput = document.querySelector('[name="SupplierName"]');
    if (supplierNames[selected]) {
        nameInput.value = supplierNames[selected];
        // Pre-fills with the default contact — admin can still edit it
    } else {
        nameInput.value = '';
    }
});

// Add one row by default
addRow();
</script>

@endsection