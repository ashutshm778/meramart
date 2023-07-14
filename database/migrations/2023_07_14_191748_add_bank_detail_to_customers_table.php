<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankDetailToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('address')->after('balance');
            $table->string('bank_name')->after('balance');
            $table->string('account_number')->after('balance');
            $table->string('ifsc_code')->after('balance');
            $table->string('branch')->after('balance');
            $table->string('bank_account_name')->after('balance');

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
            $table->dropColumn('address');
            $table->dropColumn('bank_name');
            $table->dropColumn('account_number');
            $table->dropColumn('ifsc_code');
            $table->dropColumn('branch');
            $table->dropColumn('bank_account_name');
        });
    }
}
