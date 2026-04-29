<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Fuel;

class FuelSeeder extends Seeder
{
    public function run(): void
    {
        $fuels = ['Diesel', 'Premium', 'Regular'];
        foreach ($fuels as $fuelName) {
            Fuel::firstOrCreate(['FuelName' => $fuelName]);
        }
    }
}