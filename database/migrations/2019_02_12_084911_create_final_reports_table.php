<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('final_result_id')->unsigned();
            $table->integer('section_subject_teacher_id')->unsigned();
            $table->integer('subject_marks');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('final_result_id')->references('id')->on('final_results')->onDelete('cascade');
            $table->foreign('section_subject_teacher_id')->references('id')->on('section_subject_teachers')
            ->onDelete('cascade');
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
        Schema::dropIfExists('final_reports');
    }
}
