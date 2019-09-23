<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('brand_id')->nullable();
                $table->foreign('brand_id')->references('id')->on('brands')
                    ->onDelete('set null')->onUpdate('set null');


            $table->unsignedInteger('size_id')->nullable();
                $table->foreign('size_id')->references('id')->on('sizes')
                    ->onDelete('set null')->onUpdate('set null');
                
            $table->unsignedInteger('design_id')->nullable();
                $table->foreign('design_id')->references('id')->on('designs')
                    ->onDelete('set null')->onUpdate('set null');

            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->integer('price');
            $table->integer('offer')->nullable();                    
            $table->string('link', 255);
            $table->string('photo', 100);
            $table->mediumText('gallery');
            $table->boolean('special')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->integer('views_count')->default(0);
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
        Schema::dropIfExists('products');
    }
}
