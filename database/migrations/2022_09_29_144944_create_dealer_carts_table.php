<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealerCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealer_carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sales_member_id')->nullable();
            $table->bigInteger('dealer_id');
            $table->bigInteger('product_id');
            $table->bigInteger('quantity');
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
        Schema::dropIfExists('dealer_carts');
    }
}
