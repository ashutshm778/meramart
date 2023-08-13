<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomineeToCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('nominee_name')->after('balance');
            $table->string('nominee_relation')->after('balance');
            $table->string('nominee_dob')->after('balance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('nominee_name');
            $table->dropColumn('nominee_relation');
            $table->dropColumn('nominee_dob');
        });
    }
}
