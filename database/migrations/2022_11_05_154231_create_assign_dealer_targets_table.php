<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignDealerTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_dealer_targets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('added_by');
            $table->bigInteger('dealer_id');
            $table->string('month');
            $table->string('year');
            $table->double('target_amount',20,2);
            $table->double('achive_target_amount',20,2);
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
        Schema::dropIfExists('assign_dealer_targets');
    }
}
