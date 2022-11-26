<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyTestResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_test_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('weekly_test_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->integer('weekly_test_marks');
            $table->softDeletes();
            $table->foreign('weekly_test_id')->references('id')->on('weekly_tests');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('teacher_id')->references('id')->on('teachers');

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
        Schema::dropIfExists('weekly_test_results');
    }
}
