<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * created by: Juan Sebastián Pérez Salazar
 */

class CreateDeliveryRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('date');
            $table->unsignedInteger('number_of_deliveries');
            $table->unsignedInteger('completed_deliveries');
            $table->enum('state', ['started', 'finished'])->default('started');
            $table->bigInteger('warehouse_id')->unsigned();
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->bigInteger('courier_id')->unsigned();
            $table->foreign('courier_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_routes');
    }
}
