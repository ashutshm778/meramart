<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCatImgColumnToBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brnads', function (Blueprint $table) {
            $table->text('cat_id')->nullable()->after('icon');
            $table->text('cat_img')->nullable()->after('cat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brnads', function (Blueprint $table) {
            //
        });
    }
}
