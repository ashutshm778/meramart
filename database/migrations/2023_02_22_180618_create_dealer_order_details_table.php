<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealerOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealer_order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->bigInteger('product_id');
            $table->double('product_price',8,2);
            $table->double('discount_price',8,2);
            $table->double('final_price',8,2);
            $table->bigInteger('quantity');
            $table->string('product_order_status');
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
        Schema::dropIfExists('dealer_order_details');
    }
}
