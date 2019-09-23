<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id', 8);
            $table->primary('id');
            $table->string('buyer', 8)->nullable();
                $table->foreign('buyer')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null')
                    ->onUpdate('set null');
            
            $table->string('admin_description', 255)->nullable();
            $table->string('buyer_description', 255)->nullable();
            $table->string('destination', 255);
            $table->string('postal_code', 10);
            $table->integer('offer')->default(0);
            $table->integer('shipping_cost')->default(0);
            $table->bigInteger('total')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('auth_code', 50)->nullable();
            $table->string('payment_code', 30)->nullable();
            $table->mediumText('datetimes')->nullable();
            $table->datetime('payment')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
