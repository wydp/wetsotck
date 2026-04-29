<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            ['FirstName' => 'Wacky Yuan Dwayne', 'LastName' => 'Paulino', 'ContactNumber' => '09063624950', 'Role' => 'Admin',          'IsActive' => true],
            ['FirstName' => 'John Mark',          'LastName' => 'Bolanon', 'ContactNumber' => '09317233233', 'Role' => 'Admin',          'IsActive' => true],
            ['FirstName' => 'Aprile Rose',        'LastName' => 'Bolanon', 'ContactNumber' => '09000000000', 'Role' => 'Owner',         'IsActive' => true],
            ['FirstName' => 'Juan',               'LastName' => 'Dela Cruz','ContactNumber' => '09111111111', 'Role' => 'Fuel Attendant','IsActive' => true],
        ];

        foreach ($employees as $employee) {
            Employee::firstOrCreate(
                ['FirstName' => $employee['FirstName'], 'LastName' => $employee['LastName']],
                $employee
            );
        }
    }
}