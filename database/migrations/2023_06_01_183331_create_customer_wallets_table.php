<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_wallets', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('amount')->nullable();
            $table->bigInteger('transaction_type')->nullable();
            $table->string('transaction_detail')->nullable();
            $table->string('payment_details')->nullable();
            $table->double('balance',8,2)->default(0.00);
            $table->string('approval')->nullable();
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
        Schema::dropIfExists('customer_wallets');
    }
}
