<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalesReminder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_reminders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sales_memeber_id');
            $table->bigInteger('dealer_id')->nullable();
            $table->string('name')->nullable();
            $table->string('time')->nullable();
            $table->string('date')->nullable();
            $table->text('remark')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('sales_reminders');
    }
}
