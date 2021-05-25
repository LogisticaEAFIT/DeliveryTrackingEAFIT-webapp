<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * created by: Juan Sebastián Pérez Salazar
 */

class CreateRouteSegmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_segments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('lower_time_window');
            $table->text('upper_time_window');
            $table->Integer('route_order');
            $table->double('latitude');
            $table->double('longitude');
            $table->enum('status', ['completed', 'uncompleted'])->default('uncompleted');
            $table->bigInteger('delivery_route_id')->unsigned();
            $table->foreign('delivery_route_id')->references('id')->on('delivery_routes');
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
        Schema::dropIfExists('route_segments');
    }
}
