<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('term_marks');
            $table->integer('weekly_avg');
            $table->integer('total_marks');
            $table->integer('section_student_id')->unsigned();
            $table->integer('section_subject_teacher_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->foreign('section_student_id')->references('id')->on('section_students');
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
        Schema::dropIfExists('term_results');
    }
}
