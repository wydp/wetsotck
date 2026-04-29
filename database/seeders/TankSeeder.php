<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Fuel;
use App\Models\Tank;

class TankSeeder extends Seeder
{
    public function run(): void
    {
        $tanks = [
            ['FuelName' => 'Diesel',  'MaxCapacity' => 12000.00],
            ['FuelName' => 'Premium', 'MaxCapacity' => 10000.00],
            ['FuelName' => 'Regular', 'MaxCapacity' => 8000.00],
        ];

        foreach ($tanks as $tankData) {
            $fuel = Fuel::where('FuelName', $tankData['FuelName'])->first();
            if ($fuel) {
                Tank::firstOrCreate(
                    ['FuelID' => $fuel->FuelID],
                    [
                        'FuelID'          => $fuel->FuelID,
                        'MaxCapacity'     => $tankData['MaxCapacity'],
                        'CurrentCapacity' => 0.00,
                    ]
                );
            }
        }
    }
}