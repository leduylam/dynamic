<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->integer('user_id');
            $table->dateTime('order_date');
            $table->string('status_code')->nullable();
            $table->string('total_amount')->nullable();
            $table->dateTime('shipping_start_date')->nullable();
            $table->string('memo')->nullable();
            $table->string('address')->nullable();
            $table->string('customer')->nullable();
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
