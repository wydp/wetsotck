<?php
namespace App\Http\Controllers;

use App\Models\Tank;
use App\Models\Delivery;
use App\Models\Employee;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        // onlyTrashed() → gets ONLY soft-deleted records
        $archivedTanks      = Tank::onlyTrashed()->with('fuel')->get();
        $archivedDeliveries = Delivery::onlyTrashed()->with(['supplier', 'employee'])->get();
        $archivedEmployees  = Employee::onlyTrashed()->get();
        $archivedSuppliers  = Supplier::onlyTrashed()->get();

        return view('archive.index', compact(
            'archivedTanks',
            'archivedDeliveries',
            'archivedEmployees',
            'archivedSuppliers'
        ));
    }

    public function restore(Request $request, string $type, int $id)
    {
        // Map type string to model class
        $models = [
            'tank'     => Tank::class,
            'delivery' => Delivery::class,
            'employee' => Employee::class,
            'supplier' => Supplier::class,
        ];

        if (!isset($models[$type])) {
            return redirect()->route('archive.index')
                ->with('error', 'Invalid record type.');
        }

        $model = $models[$type]::withTrashed()->findOrFail($id);
        $model->restore();
        // restore() → sets deleted_at back to NULL
        // record reappears in normal queries ✅

        return redirect()->route('archive.index')
            ->with('success', ucfirst($type) . ' restored successfully.');
    }

    public function forceDelete(Request $request, string $type, int $id)
    {
        // forceDelete() → permanently removes from database
        // Cannot be undone — use with confirmation dialog
        $models = [
            'tank'     => Tank::class,
            'delivery' => Delivery::class,
            'employee' => Employee::class,
            'supplier' => Supplier::class,
        ];

        if (!isset($models[$type])) {
            return redirect()->route('archive.index')
                ->with('error', 'Invalid record type.');
        }

        $model = $models[$type]::withTrashed()->findOrFail($id);
        $model->forceDelete();
        // forceDelete() → bypasses soft delete, actually deletes the row

        return redirect()->route('archive.index')
            ->with('success', ucfirst($type) . ' permanently deleted.');
    }
}