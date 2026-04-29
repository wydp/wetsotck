<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'SupplierID';
    protected $fillable = [
        'SupplierCompany',
        'SupplierName',
        'ContactNumber',
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