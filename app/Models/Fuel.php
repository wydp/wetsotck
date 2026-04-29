<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    protected $primaryKey = 'FuelID';
    protected $fillable = ['FuelName'];

    public function tanks()
    {
        return $this->hasMany(Tank::class, 'FuelID', 'FuelID');
    }

    public function getRouteKeyName(): string
    {
        return 'FuelID'; 
    }
}