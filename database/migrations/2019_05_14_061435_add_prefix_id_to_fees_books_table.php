<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrefixIdToFeesBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fees_books', function (Blueprint $table) {
            $table->integer('prefix_id')->unsigned();
            $table->foreign('prefix_id')->references('id')->on('prefixes')->onDelete('cascade');
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
            $table->dropForeign(['prefix_id']);
        });
    }
}
