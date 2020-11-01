<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('balance_transaction')->nullable();
            $table->string('stripe_order_id')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('discount')->nullable();
            $table->string('shipping_fee')->nullable();
            $table->string('total')->nullable();
            $table->string('return_status')->nullable()->default(0);
            $table->string('status')->nullable()->default(0);
            $table->string('status_code')->nullable();
            $table->string('order_date')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('delivery_time')->nullable();
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
