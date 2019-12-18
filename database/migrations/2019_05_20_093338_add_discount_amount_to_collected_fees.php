<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiscountAmountToCollectedFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collected_fees', function (Blueprint $table) {
             $table->integer('discount_amount')->after('total_collected');
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
            $table->dropColumn('discount_amount');
        });
    }
}
