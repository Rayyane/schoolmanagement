<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_enrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('level_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->integer('shift_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('shift_id')->references('id')->on('shifts');
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
        Schema::dropIfExists('level_enrolls');
    }
}
