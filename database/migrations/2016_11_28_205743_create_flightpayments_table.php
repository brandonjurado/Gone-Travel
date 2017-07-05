<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flightpayments', function (Blueprint $table) {
            $table->increments('id');
            $table->string("user");
            $table->string("to");
            $table->string("from");
            $table->string("startDate");
            $table->string("endDate");
            $table->string("price");
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
        Schema::drop('flightpayments');
    }
}
