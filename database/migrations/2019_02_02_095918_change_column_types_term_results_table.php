<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypesTermResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('term_results', function (Blueprint $table) {
            $table->decimal('term_marks', 5, 2)->change();
            $table->decimal('weekly_avg', 5, 2)->change();
            $table->decimal('total_marks', 5, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('term_results', function (Blueprint $table) {
            //
        });
    }
}
