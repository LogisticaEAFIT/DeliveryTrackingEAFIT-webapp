<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * created by: Juan Sebastián Pérez Salazar
 */

class EditAttributesInDeliveryRoute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_routes', function (Blueprint $table) {
            $table->unsignedInteger('number_of_deliveries')->nullable()->change();
            $table->unsignedInteger('completed_deliveries')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_routes', function (Blueprint $table) {
            
        });
    }
}
