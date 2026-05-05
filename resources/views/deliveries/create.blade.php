@extends('layouts.app')
@section('title', 'Add Delivery')
@section('breadcrumb', 'Deliveries')
@section('page-title', 'Add Delivery')

@section('content')

<form action="{{ route('deliveries.store') }}" method="POST" id="deliveryForm">
@csrf

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- LEFT: Delivery Header --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Delivery Information</h2>
            <p class="text-xs text-gray-400 mt-0.5">Fill in the delivery header details</p>
        </div>

        <div class="p-6 space-y-5">

            {{-- Supplier Company --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Supplier Company <span class="text-red-500">*</span>
                </label>
                <select name="SupplierID" id="supplierSelect" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700
                           focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent
                           bg-white transition-all">
                    <option value="">Select supplier company...</option>
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->SupplierID }}"
                            data-contact="{{ $supplier->SupplierName }}">
                        {{ $supplier->SupplierCompany }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Contact Person --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Contact Person <span class="text-red-500">*</span>
                </label>
                <input type="text" name="SupplierName" id="supplierName" required
                    placeholder="Person who arranged this delivery"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700
                           focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
                <p class="text-xs text-gray-400 mt-1">Auto-filled from supplier — edit if different person</p>
            </div>

            {{-- Driver --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Driver <span class="text-red-500">*</span>
                </label>
                <input type="text" name="Driver" required
                    placeholder="Full name of the truck driver"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700
                           focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition-all">
            </div>

            {{-- Plate Number --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Plate Number <span class="text-red-500">*</span>
                </label>
                <input type="text" name="PlateNumber" required
                    placeholder="e.g. ABC 1234"
                    class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700
                           focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent
                           font-mono transition-all">
            </div>

            {{-- Delivery Date — 3 separate fields --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Delivery Date <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Month</label>
                        <select id="delivery_month" required
                            class="w-full border border-gray-200 rounded-lg px-2 py-2.5 text-sm text-gray-700
                                   focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent bg-white">
                            <option value="">Month</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Day</label>
                        <select id="delivery_day" required
                            class="w-full border border-gray-200 rounded-lg px-2 py-2.5 text-sm text-gray-700
                                   focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent bg-white">
                            <option value="">Day</option>
                            @for($d = 1; $d <= 31; $d++)
                            <option value="{{ str_pad($d, 2, '0', STR_PAD_LEFT) }}">{{ $d }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Year</label>
                        <select id="delivery_year" required
                            class="w-full border border-gray-200 rounded-lg px-2 py-2.5 text-sm text-gray-700
                                   focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent bg-white">
                            <option value="">Year</option>
                            @for($y = now()->year; $y >= now()->year - 3; $y--)
                            <option value="{{ $y }}" {{ $y == now()->year ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                {{-- Hidden field that gets assembled by JS --}}
                <input type="hidden" name="DeliveryDate" id="deliveryDateHidden">
            </div>

            {{-- Received By --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    Received By <span class="text-red-500">*</span>
                </label>
                <select name="EmployeeID" required
                    class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700
                           focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent bg-white">
                    <option value="">Select employee...</option>
                    @foreach($employees as $employee)
                    <option value="{{ $employee->EmployeeID }}">
                        {{ $employee->FirstName }} {{ $employee->LastName }}
                        <span class="text-gray-400">({{ $employee->Role }})</span>
                    </option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>

    {{-- RIGHT: Fuel Details --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden flex flex-col">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Fuel Line Items</h2>
                <p class="text-xs text-gray-400 mt-0.5">Add one row per fuel type delivered</p>
            </div>
            <button type="button" onclick="addRow()"
                class="bg-red-600 text-white text-xs font-semibold px-3 py-2 rounded-lg
                       hover:bg-red-700 transition-colors flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Row
            </button>
        </div>

        <div class="p-6 flex-1">
            {{-- Column Headers --}}
            <div class="grid grid-cols-12 gap-2 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                <div class="col-span-4">Tank / Fuel</div>
                <div class="col-span-3">Quantity (L)</div>
                <div class="col-span-3">₱ / Liter</div>
                <div class="col-span-2 text-right">Subtotal</div>
            </div>

            {{-- Rows container --}}
            <div id="detailRows" class="space-y-3 min-h-32"></div>

            {{-- No rows placeholder --}}
            <div id="noRowsMsg" class="flex flex-col items-center justify-center py-10 text-gray-300">
                <svg class="w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <p class="text-sm">No fuel rows added yet</p>
                <p class="text-xs">Click "Add Row" to begin</p>
            </div>
        </div>

        {{-- Total Cost --}}
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between">
                <span class="text-sm font-semibold text-gray-500">Total Delivery Cost</span>
                <span class="text-xl font-bold text-gray-800">₱<span id="totalCost">0.00</span></span>
            </div>
        </div>
    </div>

</div>

{{-- Action Buttons --}}
<div class="flex items-center gap-3 mt-6">
    <button type="submit"
        class="bg-red-600 text-white px-6 py-2.5 rounded-lg hover:bg-red-700 font-semibold text-sm
               transition-colors shadow-sm flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        Save Delivery
    </button>
    <a href="{{ route('deliveries.index') }}"
        class="bg-white text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-50 font-semibold text-sm
               transition-colors border border-gray-200">
        Cancel
    </a>
</div>

</form>

<script>
// Tank options
const tanks = @json($tanks->map(fn($t) => [
    'id'    => $t->TankID,
    'label' => $t->fuel->FuelName . ' Tank',
    'fuel'  => $t->fuel->FuelName,
    'max'   => $t->MaxCapacity,
]));

// Supplier auto-fill contact
document.getElementById('supplierSelect').addEventListener('change', function() {
    const opt = this.options[this.selectedIndex];
    const contact = opt.getAttribute('data-contact');
    document.getElementById('supplierName').value = contact || '';
});

// Date assembly
function assembleDate() {
    const m = document.getElementById('delivery_month').value;
    const d = document.getElementById('delivery_day').value;
    const y = document.getElementById('delivery_year').value;
    document.getElementById('deliveryDateHidden').value = (m && d && y) ? `${y}-${m}-${d}` : '';
}
['delivery_month','delivery_day','delivery_year'].forEach(id => {
    document.getElementById(id).addEventListener('change', assembleDate);
});

// Pre-select current month/day
const now = new Date();
document.getElementById('delivery_month').value = String(now.getMonth() + 1).padStart(2, '0');
document.getElementById('delivery_day').value = String(now.getDate()).padStart(2, '0');
assembleDate();

let rowIndex = 0;

function addRow() {
    document.getElementById('noRowsMsg').style.display = 'none';
    const container = document.getElementById('detailRows');
    const idx = rowIndex++;

    let options = '<option value="">Select tank...</option>';
    tanks.forEach(t => {
        options += `<option value="${t.id}">${t.label} (max: ${Number(t.max).toLocaleString()}L)</option>`;
    });

    const div = document.createElement('div');
    div.id = `row_${idx}`;
    div.className = 'grid grid-cols-12 gap-2 items-center bg-gray-50 rounded-lg p-2 border border-gray-100';
    div.innerHTML = `
        <div class="col-span-4">
            <select name="details[${idx}][TankID]" required onchange="calcRow(${idx})"
                class="w-full border border-gray-200 rounded-lg px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 bg-white">
                ${options}
            </select>
        </div>
        <div class="col-span-3">
            <input type="number" name="details[${idx}][Quantity]"
                placeholder="0.00" min="0.01" step="0.01" required
                onkeyup="calcRow(${idx})" onchange="calcRow(${idx})"
                class="w-full border border-gray-200 rounded-lg px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
        </div>
        <div class="col-span-3">
            <input type="number" name="details[${idx}][UnitCost]"
                placeholder="0.00" min="0.01" step="0.01" required
                onkeyup="calcRow(${idx})" onchange="calcRow(${idx})"
                class="w-full border border-gray-200 rounded-lg px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400">
        </div>
        <div class="col-span-1 text-right text-xs font-semibold text-gray-600">
            <span id="sub_${idx}">0.00</span>
        </div>
        <div class="col-span-1 flex justify-end">
            <button type="button" onclick="removeRow(${idx})"
                class="w-6 h-6 flex items-center justify-center rounded text-gray-400
                       hover:text-red-500 hover:bg-red-50 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    `;
    container.appendChild(div);
}

function calcRow(idx) {
    const qty  = parseFloat(document.querySelector(`[name="details[${idx}][Quantity]"]`)?.value) || 0;
    const cost = parseFloat(document.querySelector(`[name="details[${idx}][UnitCost]"]`)?.value) || 0;
    const sub  = qty * cost;
    const el   = document.getElementById('sub_' + idx);
    if (el) el.textContent = sub.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    calcTotal();
}

function calcTotal() {
    let total = 0;
    document.querySelectorAll('[id^="sub_"]').forEach(el => {
        total += parseFloat(el.textContent.replace(/,/g, '')) || 0;
    });
    document.getElementById('totalCost').textContent =
        total.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function removeRow(idx) {
    document.getElementById('row_' + idx)?.remove();
    calcTotal();
    if (document.getElementById('detailRows').children.length === 0) {
        document.getElementById('noRowsMsg').style.display = 'flex';
    }
}

// Validate date before submit
document.getElementById('deliveryForm').addEventListener('submit', function(e) {
    const date = document.getElementById('deliveryDateHidden').value;
    if (!date) {
        e.preventDefault();
        alert('Please select a complete delivery date (month, day, and year).');
        return;
    }
    if (document.getElementById('detailRows').children.length === 0) {
        e.preventDefault();
        alert('Please add at least one fuel row.');
        return;
    }
});

// Add first row automatically
addRow();
</script>

@endsection