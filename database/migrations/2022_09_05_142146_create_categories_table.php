<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->text('descrption')->nullable();
            $table->double('commision',8,2)->default(0.00);
            $table->bigInteger('icon')->nullable();
            $table->bigInteger('banner')->nullable();
            $table->boolean('is_feature')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('priority');
            $table->boolean('nav_priority');
            $table->boolean('top_priority');
            $table->boolean('bottom_priority');
            $table->string('meta_name');
            $table->text('meta_descrption')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
