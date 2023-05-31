<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['total_order_amount', 'product_base']);
            $table->string('code');
            $table->bigInteger('image')->nullable();
            $table->text('description')->nullable();
            $table->text('product_ids')->nullable();
            $table->double('minimum_order_value',8,2)->default(0.00);
            $table->double('maximum_discount_amount',8,2)->default(0.00);
            $table->double('discount',8,2)->default(0.00);
            $table->enum('discount_type', ['amount', 'percent']);
            $table->bigInteger('start_date')->nullable();
            $table->bigInteger('end_date')->nullable();
            $table->integer('number_of_usages')->default(1);
            $table->enum('is_active', [1,0])->default(0);
            $table->enum('is_delete', [1,0])->default(0);
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
        Schema::dropIfExists('coupons');
    }
}
