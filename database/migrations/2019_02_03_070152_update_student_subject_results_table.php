<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStudentSubjectResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_subject_results', function (Blueprint $table) {
            $table->dropForeign('student_subject_results_student_id_foreign');
            $table->dropForeign('student_subject_results_section_subject_teacher_id_foreign');
            $table->dropForeign('student_subject_results_term_id_foreign');

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('section_subject_teacher_id')->references('id')
            ->on('section_subject_teachers')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_subject_results', function (Blueprint $table) {
            //
        });
    }
}
