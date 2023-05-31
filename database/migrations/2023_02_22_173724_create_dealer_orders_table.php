<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealer_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('order_request_id');
            $table->bigInteger('sales_member_id');
            $table->bigInteger('ordered_by');
            $table->bigInteger('dealer_id');
            $table->double('grand_total',8,2);
            $table->double('total_discount',8,2);
            $table->text('address')->nullable();
            $table->string('order_status');
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
        Schema::dropIfExists('dealer_orders');
    }
}
