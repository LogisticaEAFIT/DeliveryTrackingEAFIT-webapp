<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributesToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('id_card_number');
            $table->boolean('is_active');
            $table->enum('role', ['SuperAdmin', 'CompanyAdmin', 'WarehouseAdmin', 'Courier']);
            // Llave foranea de la tabla companies
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['id_card_number']);
            $table->dropColumn(['is_active']); 
            $table->dropColumn(['role']); 
        });
    }
}