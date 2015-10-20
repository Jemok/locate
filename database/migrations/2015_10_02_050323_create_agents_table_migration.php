<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('businessNumber')->unique();
            $table->string('agentName');
            $table->string('agentEmail')->unique()->nullable();
            $table->integer('agentMobileNumber');
            $table->string('openingHourWeekDay');
            $table->string('closingHourWeekDay');
            $table->string('openingHourSaturday');
            $table->string('closingHourSaturday');
            $table->string('openingHourSunday');
            $table->string('closingHourSunday');
            $table->integer('user_id')->index()->unsigned();

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
        Schema::drop('agents');
    }
}
