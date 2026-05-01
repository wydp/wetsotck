<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey = 'EmployeeID';
    protected $fillable = [
        'FirstName',
        'MiddleName',
        'LastName',
        'ContactNumber',
        'Address',
        'Role',
        'IsActive',
    ];

    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'EmployeeID', 'EmployeeID');
    }

    public function getRouteKeyName(): string
    {
        return 'EmployeeID'; 
    }
}