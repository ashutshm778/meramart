<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPersonRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_person_requests', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->bigInteger('phone');
            $table->string('email')->nullable();
            $table->string('type');
            $table->string('business_name');
            $table->string('brand_name')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('gstin_number')->nullable();
            $table->string('gstin_document')->nullable();
            $table->string('address')->nullable();
            $table->boolean('verify_status')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('business_person_requests');
    }
}
