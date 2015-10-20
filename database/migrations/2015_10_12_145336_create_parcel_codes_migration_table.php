<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcelCodesMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('parcelCode');
            $table->integer('parcel_id');
            $table->integer('parcelSendingCharges');
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
        Schema::drop('parcel_codes');
    }
}
