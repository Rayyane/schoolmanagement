<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_subject_teacher_id')->unsigned();
            $table->string('Weekly_test_name');
            $table->softDeletes();
            $table->foreign('section_subject_teacher_id')->references('id')->on('section_subject_teachers');

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
        Schema::dropIfExists('weekly_tests');
    }
}
