<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->bigInteger('product_id');
            $table->integer('quantity');
            $table->double('mrp_price',8,2);
            $table->double('price',8,2);
            $table->double('discounted_price',8,2)->default(0.00);
            $table->double('tax',8,2)->deafult(0.00);
            $table->double('shipping_cost',8,2)->default(0.00);
            $table->double('coupon_discount',8,2)->default(0.00);
            $table->double('wallet_discount',8,2)->default(0.00);
            $table->enum('order_status',['pending','confirm','on_delivery','delivered','cancel','returned'])->default('pending');
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
    }
}
