<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersinfo', function (Blueprint $table) {
            $table->string ('first');
            $table->string ('last');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->bigInteger('type');
            $table->bigInteger ('id');

            $table->foreign('id')->references('id')->on('users');
            $table->foreign('type')->references('id')->on('usertypes');
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
        Schema::dropIfExists('usersinfo');
    }
}
