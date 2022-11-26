<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLeafNumberTypeOnFeesBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fees_books', function (Blueprint $table) {
            $table->integer('leaf_start_number')->change();
            $table->integer('leaf_end_number')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fees_books', function (Blueprint $table) {
            //
        });
    }
}
