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
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_user');
            $table->string('slug');
            $table->string('time_take');
            $table->date('date');
            $table->integer('quantity');
            $table->float('value');
            $table->string('status')->default('enable');
            $table->timestamps();

            $table->foreign('id_client')->references('id')->on('clients')->onDelete('CASCADE');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demands', function($table){
            $table->integer('quantity');
        });
    }
}
