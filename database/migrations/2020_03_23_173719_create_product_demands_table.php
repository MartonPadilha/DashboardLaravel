<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_demands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_demand');
            $table->unsignedBigInteger('id_product');

            $table->foreign('id_demand')->references('id')->on('demands')->onDelete('CASCADE');
            $table->foreign('id_product')->references('id')->on('products')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_demands');
    }
}
