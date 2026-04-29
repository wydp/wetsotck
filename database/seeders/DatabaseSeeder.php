<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            FuelSeeder::class,      // first — tanks need fuels
            TankSeeder::class,      // second — needs fuels
            SupplierSeeder::class,  // independent
            EmployeeSeeder::class,  // independent
        ]);
    }
}