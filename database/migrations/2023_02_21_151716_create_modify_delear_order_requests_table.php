<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModifyDelearOrderRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modify_delear_order_requests', function (Blueprint $table) {
            $table->id();
            $table->string('order_request_id');
            $table->string('modify_order_request_id');
            $table->bigInteger('product_id');
            $table->double('product_price',15,2);
            $table->double('product_discount',15,2);
            $table->double('product_discount_amount',15,2);
            $table->bigInteger('product_quantity');
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
        Schema::dropIfExists('modify_delear_order_requests');
    }
}
