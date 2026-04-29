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
        Schema::create('delivery_details', function (Blueprint $table) {
            $table->id('DeliveryDetailID');
            $table->unsignedBigInteger('DeliveryID');
            // NOT nullable — detail cannot exist without a delivery
            $table->unsignedBigInteger('TankID');
            // NOT nullable — must specify which tank fuel goes into
            $table->decimal('Quantity', 10, 2);
            // Liters delivered to this tank
            $table->decimal('UnitCost', 10, 2);
            // Price per liter
            $table->decimal('Subtotal', 10, 2)->nullable();
            // Quantity × UnitCost — computed automatically
            $table->timestamps();

            $table->foreign('DeliveryID')
                ->references('DeliveryID')
                ->on('deliveries')
                ->onDelete('cascade');
            // cascade → delete details if delivery is deleted

            $table->foreign('TankID')
                ->references('TankID')
                ->on('tanks')
                ->onDelete('restrict');
            // restrict → cannot delete a tank with delivery history
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_details');
    }
};
