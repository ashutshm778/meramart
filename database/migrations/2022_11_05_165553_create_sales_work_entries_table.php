<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesWorkEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_work_entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sales_memeber_id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('unit')->nullable();
            $table->string('image')->nullable();
            $table->text('localtion')->nullable();
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
        Schema::dropIfExists('sales_work_entries');
    }
}
