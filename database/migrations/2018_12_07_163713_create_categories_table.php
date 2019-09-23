<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent')->unsigned()->nullable();
                $table->foreign('parent')->references('id')->on('categories')
                    ->onDelete('set null')->onUpdate('set null');
                    
            $table->string('title', 50);
            $table->string('description', 255)->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('banner', 100)->nullable();
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
        Schema::dropIfExists('categories');
    }
}
