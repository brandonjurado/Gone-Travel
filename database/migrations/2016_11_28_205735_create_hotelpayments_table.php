<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotelpayments', function (Blueprint $table) {
            $table->increments('id');
            $table->string("user");
            $table->string("roomType");
            $table->string("hotel");
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
        Schema::drop('hotelpayments');
    }
}
