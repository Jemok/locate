<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitizensTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nationalId')->unique();
            $table->string('firstName');
            $table->string('secondName');
            $table->string('thirdName');
            $table->date('dateOfBirth');
            $table->integer('mobileNumber')->unique();
            $table->integer('otherMobileNumber')->nullable()->unique();
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
        Schema::drop('citizens');
    }
}
