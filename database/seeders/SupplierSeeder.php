<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            ['SupplierCompany' => 'Petron Corporation', 'SupplierName' => 'Ramon Dela Cruz', 'ContactNumber' => '09171234567'],
            ['SupplierCompany' => 'Shell Philippines',  'SupplierName' => 'Maria Santos',    'ContactNumber' => '09281234567'],
            ['SupplierCompany' => 'Phoenix Petroleum',  'SupplierName' => 'Jose Reyes',      'ContactNumber' => '09391234567'],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::firstOrCreate(
                ['SupplierCompany' => $supplier['SupplierCompany']],
                $supplier
            );
        }
    }
}