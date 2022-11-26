<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubjectResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subject_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('weekly_test_number');
            $table->integer('weekly_test_marks');
            $table->integer('student_id')->unsigned();
            $table->integer('section_subject_teacher_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('section_subject_teacher_id')->references('id')
            ->on('section_subject_teachers');
            $table->foreign('term_id')->references('id')->on('terms');
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
        Schema::dropIfExists('student_subject_results');
    }
}
