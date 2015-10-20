<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->integer('level')->index()->unsigned();
            $table->string('password', 60);
            $table->rememberToken();
            $table->integer('streetCount');
            $table->timestamps();
            $table->integer('clientCitizen')->default(0);
            $table->integer('clientAgent')->default(0);
            $table->integer('clientDistributor')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
