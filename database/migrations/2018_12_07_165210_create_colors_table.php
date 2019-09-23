<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name', 30);
            $table->string('value', 9);
            $table->timestamps();
        });
	    Schema::create('color_product', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('color_id')->unsigned()->nullable();
		    $table->integer('product_id')->unsigned()->nullable();
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
        Schema::dropIfExists('colors');
    }
}
