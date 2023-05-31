<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('name');
            $table->string('country');
            $table->bigInteger('state');
            $table->bigInteger('city');
            $table->string('pincode');
            $table->bigInteger('phone');
            $table->text('address');
            $table->enum('address_type',['home','workplace','other'])->default('home');
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
        Schema::dropIfExists('customer_addresses');
    }
}
