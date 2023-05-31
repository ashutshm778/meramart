<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealerOrderRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealer_order_requests', function (Blueprint $table) {
            $table->id();
            $table->string('order_request_id');
            $table->bigInteger('sales_member_id')->nullable();
            $table->bigInteger('dealer_id');
            $table->bigInteger('product_id');
            $table->double('product_price',2);
            $table->string('product_discount_type');
            $table->double('product_discount',2);
            $table->double('product_discount_amount',2);
            $table->bigInteger('product_quantity');
            $table->string('request_status');
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
        Schema::dropIfExists('dealer_order_requests');
    }
}
