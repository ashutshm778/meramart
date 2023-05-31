<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualification_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('qualification')->nullable();
            $table->string('university')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('year_of_passing')->nullable();
            $table->string('percentage')->nullable();
            $table->string('marks_memo')->nullable();
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
        Schema::dropIfExists('qualification_details');
    }
}
