<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // ← add this line

class Supplier extends Model
{
    use SoftDeletes; // ← add this line

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
}