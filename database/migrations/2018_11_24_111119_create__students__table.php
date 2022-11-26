<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('roll_no');
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->date('date_of_birth');
            $table->date('admission_date');
            $table->string('nationality');
            $table->string('religion');
            $table->string('gender');
            $table->string('present_address');
            $table->string('permanent_address');
            $table->string('contact_no');
            $table->string('fathers_cell');
            $table->string('mothers_cell');
            $table->string('student_photo', 150)->unique();
            $table->softDeletes();

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
        Schema::dropIfExists('students');
    }
}
