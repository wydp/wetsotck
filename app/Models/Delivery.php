<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $primaryKey = 'DeliveryID';
    protected $fillable = [
        'SupplierID',
        'SupplierName',
        'Driver',
        'PlateNumber',
        'TotalCost',
        'EmployeeID',
        'DeliveryDate',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierID', 'SupplierID');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'EmployeeID', 'EmployeeID');
    }

    public function deliveryDetails()
    {
        return $this->hasMany(DeliveryDetail::class, 'DeliveryID', 'DeliveryID');
    }

    public function getRouteKeyName(): string
    {
        return 'DeliveryID'; 
    }
}