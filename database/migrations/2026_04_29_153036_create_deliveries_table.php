<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id('DeliveryID');
            $table->unsignedBigInteger('SupplierID')->nullable();
            $table->string('Driver', 100);
            // NOT nullable — no delivery without a driver
            $table->string('PlateNumber', 20);
            // NOT nullable — no delivery without a vehicle
            $table->decimal('TotalCost', 10, 2)->nullable();
            // Computed after delivery details are added
            $table->unsignedBigInteger('EmployeeID')->nullable();
            // FK to employees — who received this delivery
            $table->date('DeliveryDate');
            // NOT nullable — no delivery without a date
            $table->timestamps();

            $table->foreign('SupplierID')
                ->references('SupplierID')
                ->on('suppliers')
                ->onDelete('set null');

            $table->foreign('EmployeeID')
                ->references('EmployeeID')
                ->on('employees')
                ->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
