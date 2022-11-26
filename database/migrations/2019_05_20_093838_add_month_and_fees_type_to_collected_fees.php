<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMonthAndFeesTypeToCollectedFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collected_fees', function (Blueprint $table) {
            $table->string('business_month_id')->after('total_due');
            $table->string('section_wise_fees_ids')->after('business_month_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collected_fees', function (Blueprint $table) {
            $table->dropColumn('business_month_id');
            $table->dropColumn('section_wise_fees_ids');
        });
    }
}
