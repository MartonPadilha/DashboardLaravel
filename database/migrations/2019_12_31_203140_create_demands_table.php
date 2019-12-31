<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_client')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('time_take');
            $table->integer('quantity');
            $table->float('value');
            $table->timestamps();

            $table->foreign('id_client')->references('id')->on('clients')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demands');
    }
}
