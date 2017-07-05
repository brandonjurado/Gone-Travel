<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hotelName');
            $table->integer('stars');
            $table->integer('price');
            $table->string('cityName');
            $table->string('stateName');
            $table->string('countryCode');
            $table->string('countryName');
            $table->string('address');
            $table->string('location');
            $table->string('url');
            $table->string('tripadvisorUrl');
            $table->integer('latitude');
            $table->integer('longitude');
            $table->integer('latlong');
            $table->integer('propertyType');
            $table->integer('chainId');
            $table->integer('rooms');
            $table->string('facilities');
            $table->boolean('checkIn');
            $table->boolean('checkOut');
            $table->integer('rating');

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
        Schema::drop('hotels');
    }
}
