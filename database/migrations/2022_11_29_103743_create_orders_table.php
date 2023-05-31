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
            $table->string('order_id');
            $table->bigInteger('user_id');
            $table->bigInteger('staff_id')->nullable();
            $table->double('grand_total',8,2);
            $table->double('total_product_discount',8,2)->default(0.00);
            $table->double('coupon_discount',8,2)->default(0.00);
            $table->double('wallet_discount',8,2)->default(0.00);
            $table->text('shipping_address');
            $table->enum('order_status',['pending','confirm','on_delivery','delivered','cancel','returned'])->default('pending');
            $table->enum('payment_type', ['cod','razorpay']);
            $table->text('payment_details')->nullable();
            $table->enum('payment_status',['pending','success','cancel'])->default('pending');
            $table->text('remark')->nullable();
            $table->string('shippment_id')->nullable();
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
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
    }
}
