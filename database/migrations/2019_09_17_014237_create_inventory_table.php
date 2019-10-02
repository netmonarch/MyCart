<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('category')->default(0);
            $table->string('picture')->default(0);
            $table->integer('quantity')->default(1);
            $table->double('price', 8,2)->default(0.00);
            $table->string('info')->default('');
            $table->string('SKU')->default('none');
            $table->timestamps();
			
			$table->foreign('category')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
