<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
    protected $primaryKey = 'DeliveryDetailID';
    protected $fillable = [
        'DeliveryID',
        'TankID',
        'Quantity',
        'UnitCost',
        'Subtotal',
    ];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'DeliveryID', 'DeliveryID');
    }

    public function tank()
    {
        return $this->belongsTo(Tank::class, 'TankID', 'TankID');
    }

    public function getRouteKeyName(): string
    {
        return 'DeliveryDetailID'; 
    }
}