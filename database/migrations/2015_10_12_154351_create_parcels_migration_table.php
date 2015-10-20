<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcelsMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('parcelName');
            $table->integer('parcelWeight');
            $table->string('parcelCategory');
            $table->integer('user_id');
            $table->integer('parcelStatus')->default(1);
            $table->integer('parcelPendingStatus')->default(0);
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
        Schema::drop('parcels');
    }
}
