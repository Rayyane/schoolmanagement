<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSectionStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('section_students', function (Blueprint $table) {
            $table->dropForeign('section_students_section_id_foreign');
            $table->dropForeign('section_students_student_id_foreign');

            $table->foreign('section_id')->references('id')->on('sections')
            ->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')
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
        Schema::table('section_students', function (Blueprint $table) {
            //
        });
    }
}
