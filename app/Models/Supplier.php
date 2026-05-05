<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes; // ← add this trait

    protected $primaryKey = 'SupplierID';
    protected $fillable = [
        'SupplierCompany',
        'SupplierName',
        'ContactNumber',
        'Address',
    ];

    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'SupplierID', 'SupplierID');
    }

    public function getRouteKeyName(): string
    {
        return 'SupplierID'; 
    }
}