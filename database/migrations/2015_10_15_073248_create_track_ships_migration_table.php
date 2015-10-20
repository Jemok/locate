<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackShipsMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_ships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parcel_id');
            $table->integer('sender_id');
            $table->integer('sender_address');
            $table->integer('receiver_address');
            $table->integer('receiver_id');
            $table->integer('agent_sender');
            $table->integer('agent_receiver');
            $table->integer('ship_status');
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
        Schema::drop('track_ships');
    }
}
