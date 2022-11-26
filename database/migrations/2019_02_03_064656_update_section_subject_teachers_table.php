<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSectionSubjectTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('section_subject_teachers', function (Blueprint $table) {
            $table->dropForeign('section_subject_teachers_subject_id_foreign');
            $table->dropForeign('section_subject_teachers_teacher_id_foreign');
            $table->dropForeign('section_subject_teachers_section_id_foreign');

            $table->foreign('subject_id')->references('id')->on('subjects')
            ->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')
            ->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('section_subject_teachers', function (Blueprint $table) {
            //
        });
    }
}
