<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lines', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materials');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->enum('unit', ['Mts', 'Kgs', 'Unidades']); //Unidades
            $table->integer('quantity'); //Cantidad de la unidad

            $table->double('unit_price', 8, 2); //Precio Unitario
            $table->double('percentage', 5, 2); //Porcentaje de descuento
            $table->double('unit_price_discount', 8, 2); // Precio Unitario con Descuento

            $table->double('sub_total', 11, 2); //Sub-Total
            $table->double('iva', 11, 2); //Iva
            $table->double('total', 11, 2); //Total con descuento

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
        Schema::dropIfExists('lines');
    }
}
