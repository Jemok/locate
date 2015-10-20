<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcelDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parcel_id');
            $table->integer('parcelDeliveryMethod');
            $table->string('parcelDeliveryDate');
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
        Schema::drop('parcel_deliveries');
    }
}
