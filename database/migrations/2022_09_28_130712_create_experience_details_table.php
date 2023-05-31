<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('institute_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('Year_of_exp')->nullable();
            $table->string('starting_salary')->nullable();
            $table->string('ending_salary')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('experience_details');
    }
}
