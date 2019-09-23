<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id', 8);
                $table->foreign('order_id')
                        ->references('id')
                        ->on('orders')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
                        
            $table->unsignedInteger('product_id')->nullable();
                $table->foreign('product_id')
                        ->references('id')
                        ->on('products')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->integer('count')->unsigned();
            $table->integer('price')->unsigned()->default(0);
            $table->integer('offer')->unsigned()->default(0);
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
        Schema::dropIfExists('order_products');
    }
}
