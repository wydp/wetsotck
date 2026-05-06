<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // ← add


class Tank extends Model
{
    use SoftDeletes; // ← add


    protected $primaryKey = 'TankID';
    protected $fillable = [
        'FuelID',
        'MaxCapacity',
        'CurrentCapacity',
    ];

    public function fuel()
    {
        return $this->belongsTo(Fuel::class, 'FuelID', 'FuelID');
    }

    public function deliveryDetails()
    {
        return $this->hasMany(DeliveryDetail::class, 'TankID', 'TankID');
    }

    public function getRouteKeyName(): string
    {
        return 'TankID'; 
    }
}