<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->string('category_id');
            $table->string('subcategory_id');
            $table->text('descrption')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('sub_sub_categories');
    }
}
