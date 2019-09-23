<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slidables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('slide_id')->nullable();
                $table->foreign('slide_id')->references('id')->on('slides')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('slidable_id');
            $table->string('slidable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slidables');
    }
}
